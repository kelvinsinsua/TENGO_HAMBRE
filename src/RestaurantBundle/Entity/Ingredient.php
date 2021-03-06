<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Plate", inversedBy="ingredients")
     * @ORM\JoinColumn(name="plate_id", referencedColumnName="id")
     */
       
    private $plate;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ingredient
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set plate
     *
     * @param \RestaurantBundle\Entity\Plate $plate
     * @return Ingredient
     */
    public function setPlate(\RestaurantBundle\Entity\Plate $plate = null)
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * Get plate
     *
     * @return \RestaurantBundle\Entity\Plate 
     */
    public function getPlate()
    {
        return $this->plate;
    }
}
