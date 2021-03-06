<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aditional
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aditional
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="aditionals")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
       
    private $restaurant;
    
     /**
     * @ORM\ManyToMany(targetEntity="Plate", mappedBy="aditionals")
     */
     private $plates;


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
     * @return Aditional
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
     * Set price
     *
     * @param float $price
     * @return Aditional
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set restaurant
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurant
     * @return Aditional
     */
    public function setRestaurant(\RestaurantBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \RestaurantBundle\Entity\Restaurant 
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add plates
     *
     * @param \RestaurantBundle\Entity\Plate $plates
     * @return Aditional
     */
    public function addPlate(\RestaurantBundle\Entity\Plate $plates)
    {
        $this->plates[] = $plates;

        return $this;
    }

    /**
     * Remove plates
     *
     * @param \RestaurantBundle\Entity\Plate $plates
     */
    public function removePlate(\RestaurantBundle\Entity\Plate $plates)
    {
        $this->plates->removeElement($plates);
    }

    /**
     * Get plates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlates()
    {
        return $this->plates;
    }
}
