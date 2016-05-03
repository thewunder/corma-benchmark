<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * TestObject
 *
 * @ORM\Table(name="test_objects", indexes={@ORM\Index(name="associatedObjectId", columns={"associatedObjectId"})})
 * @ORM\Entity
 */
class TestObjects
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
     * @var \AssociatedObjects
     *
     * @ORM\ManyToOne(targetEntity="AssociatedObject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associatedObjectId", referencedColumnName="id")
     * })
     */
    private $associatedobjectid;


}

