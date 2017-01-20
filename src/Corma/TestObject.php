<?php
namespace CormaBenchmark\Corma;

class TestObject
{

    protected $id;
    protected $name;
    protected $description;
    protected $associatedObjectId;

    /** @var  AssociatedObject */
    protected $associatedObject;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssociatedObjectId()
    {
        return $this->associatedObjectId;
    }

    /**
     * @param mixed $associatedObjectId
     */
    public function setAssociatedObjectId($associatedObjectId)
    {
        $this->associatedObjectId = $associatedObjectId;
    }

    /**
     * @return AssociatedObject
     */
    public function getAssociatedObject()
    {
        return $this->associatedObject;
    }

    /**
     * @param AssociatedObject $associatedObject
     * @return $this
     */
    public function setAssociatedObject(AssociatedObject $associatedObject)
    {
        $this->associatedObject = $associatedObject;
        return $this;
    }
}