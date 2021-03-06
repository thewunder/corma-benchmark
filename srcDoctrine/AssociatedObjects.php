<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AssociatedObject
 *
 * @ORM\Table(name="associated_objects")
 * @ORM\Entity
 */
class AssociatedObjects
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


}

