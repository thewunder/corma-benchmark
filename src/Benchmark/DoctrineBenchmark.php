<?php
namespace CormaBenchmark\Benchmark;

use CormaBenchmark\Doctrine\AssociatedObject;
use CormaBenchmark\Doctrine\TestObject;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class DoctrineBenchmark extends Benchmark
{
    /** @var  EntityManager */
    private $entityManager;

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        $this->createDatabase();
        return $this->entityManager;
    }

    protected function connect()
    {
        parent::connect();

        $this->stopwatch->start('Initialization', 'Initialization');
        $reader = new AnnotationReader();
        $driver = new AnnotationDriver($reader, [__DIR__ . '/../Doctrine']);
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../Doctrine'], true, '/tmp/' . 'proxy', new ArrayCache());
        $config->setMetadataDriverImpl($driver);
        $config->addEntityNamespace('Lifestyle', 'Lifestyle\\Entity\\');
        $this->entityManager = EntityManager::create($this->connection, $config);
        $this->stopwatch->stop('Initialization');
    }

    public function runBenchmarks()
    {
        $orm = $this->entityManager;

        /** @var TestObject[] $objects */
        $objects = [];
        for($i=0; $i < 1000; $i++) {
            $object = new TestObject();
            $objects[] = $object->setName("Test Object $i")
                ->setDescription("Test Object $i Description");
        }
        $this->stopwatch->start('Insert 1000 objects', 'Insert 1000 objects');
        foreach ($objects as $object) {
            $orm->persist($object);
        }
        $orm->flush();
        $this->stopwatch->stop('Insert 1000 objects');

        /** @var AssociatedObject[] $associated */
        $associated = [];
        for($i=0; $i < 1000; $i++) {
            /** @var AssociatedObject $associatedObj */
            $associatedObj = new AssociatedObject();
            $associated[] = $associatedObj->setName("Associated Object $i");
        }
        $this->stopwatch->start('Insert 1000 associated objects', 'Insert 1000 associated objects');
        foreach ($associated as $associatedObj) {
            $orm->persist($associatedObj);
        }
        $orm->flush();
        $this->stopwatch->stop('Insert 1000 associated objects');

        foreach ($objects as $i => $object) {
            $object->setName($object->getName() . ' Updated')
                ->setDescription($object->getDescription() . ' Updated')
                ->setAssociatedObject($associated[$i]);
        }
        $this->stopwatch->start('Update 1000 objects', 'Update 1000 objects');
        foreach ($objects as $object) {
            $orm->persist($object);
        }
        $orm->flush();
        $this->stopwatch->stop('Update 1000 objects');

        $this->stopwatch->start('Load 1000 objects with associated', 'Load 1000 objects with associated');
        $objects = $orm->getRepository(TestObject::class)->findAll();
        $this->stopwatch->stop('Load 1000 objects with associated');
        
        $this->stopwatch->start('Delete 1000 objects', 'Delete 1000 objects');
        foreach ($objects as $object) {
            $orm->remove($object);
        }
        $orm->flush();
        $this->stopwatch->stop('Delete 1000 objects');
    }
}