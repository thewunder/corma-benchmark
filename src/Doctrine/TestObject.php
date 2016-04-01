<?php

namespace CormaBenchmark\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestObject
 *
 * @ORM\Table(name="test_objects", indexes={@ORM\Index(name="associatedObjectId", columns={"associatedObjectId"})})
 * @ORM\Entity
 */
class TestObject
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AssociatedObject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associatedObjectId", referencedColumnName="id")
     * })
     * 
     * @var \CormaBenchmark\Doctrine\AssociatedObject
     */
    private $associatedObject;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TestObject
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
     * @return TestObject
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return TestObject
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param AssociatedObject $associatedObject
     * @return TestObject
     */
    public function setAssociatedObject($associatedObject)
    {
        $this->associatedObject = $associatedObject;
        return $this;
    }

    /**
     * @return AssociatedObject
     */
    public function getAssociatedObject()
    {
        return $this->associatedObject;
    }
}

