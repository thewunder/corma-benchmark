<?php
namespace CormaBenchmark\Doctrine;


use Doctrine\ORM\Mapping as ORM;

/**
 * AssociatedObject
 *
 * @ORM\Table(name="associated_objects")
 * @ORM\Entity
 */
class AssociatedObject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AssociatedObject
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AssociatedObject
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}

