<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Menu
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
     * @var string
     *
     * @ORM\Column(name="about", type="string", length=255)
     */
    private $about;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="menus")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
       
    private $restaurant;
    
    /**
     * @ORM\OneToMany(targetEntity="Plate", mappedBy="menu")
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
     * @return Menu
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
     * Set about
     *
     * @param string $about
     * @return Menu
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set available
     *
     * @param boolean $available
     * @return Menu
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean 
     */
    public function getAvailable()
    {
        return $this->available;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set restaurant
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurant
     * @return Menu
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
     * Add plates
     *
     * @param \RestaurantBundle\Entity\Plate $plates
     * @return Menu
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
