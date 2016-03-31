<?php
namespace CormaBenchmark\Corma;

use Corma\DataObject\DataObject;

class AssociatedObject extends DataObject
{
    protected $name;

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
}