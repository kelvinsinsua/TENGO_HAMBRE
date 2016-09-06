<?php

namespace ParametersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amenity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Amenity
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
     * @ORM\ManyToMany(targetEntity="\RestaurantBundle\Entity\Restaurant", mappedBy="amenities")
     */
     private $restaurants;


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
     * @return Amenity
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
     * Constructor
     */
    public function __construct()
    {
        $this->restaurants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add restaurants
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurants
     * @return Amenity
     */
    public function addRestaurant(\RestaurantBundle\Entity\Restaurant $restaurants)
    {
        $this->restaurants[] = $restaurants;

        return $this;
    }

    /**
     * Remove restaurants
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurants
     */
    public function removeRestaurant(\RestaurantBundle\Entity\Restaurant $restaurants)
    {
        $this->restaurants->removeElement($restaurants);
    }

    /**
     * Get restaurants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }
}
