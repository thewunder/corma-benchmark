<?php
namespace CormaBenchmark\Benchmark;

use Corma\ObjectMapper;
use CormaBenchmark\Corma\AssociatedObject;
use CormaBenchmark\Corma\TestObject;
use Doctrine\Common\Cache\ArrayCache;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CormaBenchmark extends Benchmark
{
    public function runBenchmarks()
    {
        $this->stopwatch->start('Initialization', 'Initialization');
        $orm = ObjectMapper::withDefaults($this->connection, ['CormaBenchmark\\Corma'], new ArrayCache(), new EventDispatcher());
        $this->stopwatch->stop('Initialization');

        $objects = [];
        for($i=0; $i < 1000; $i++) {
            /** @var TestObject $object */
            $object = $orm->create(TestObject::class);
            $objects[] = $object->setName("Test Object $i")
                ->setDescription("Test Object $i Description");
        }
        $this->stopwatch->start('Insert 1000 objects', 'Insert 1000 objects');
        $orm->saveAll($objects);
        $this->stopwatch->stop('Insert 1000 objects');

        /** @var AssociatedObject[] $associated */
        $associated = [];
        for($i=0; $i < 1000; $i++) {
            /** @var AssociatedObject $associatedObj */
            $associatedObj = $orm->create(AssociatedObject::class);
            $associated[] = $associatedObj->setName("Associated Object $i");
        }
        $this->stopwatch->start('Insert 1000 associated objects', 'Insert 1000 associated objects');
        $orm->saveAll($associated);
        $this->stopwatch->stop('Insert 1000 associated objects');

        foreach ($objects as $i => $object) {
            $object->setName($object->getName() . ' Updated')
                ->setDescription($object->getDescription() . ' Updated')
                ->setAssociatedObjectId($associated[$i]->getId());
        }
        $this->stopwatch->start('Update 1000 objects', 'Update 1000 objects');
        $orm->saveAll($objects);
        $this->stopwatch->stop('Update 1000 objects');

        $this->stopwatch->start('Load 1000 objects with associated', 'Load 1000 objects with associated');
        $objects = $orm->findAll(TestObject::class);
        $orm->loadOne($objects, AssociatedObject::class);
        $this->stopwatch->stop('Load 1000 objects with associated');
        
        $this->stopwatch->start('Delete 1000 objects', 'Delete 1000 objects');
        $orm->deleteAll($objects);
        $this->stopwatch->stop('Delete 1000 objects');
    }
}