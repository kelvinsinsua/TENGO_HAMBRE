<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DrinkCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DrinkCategory
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="drinkCategories")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
       
    private $restaurant;
    
    /**
     * @ORM\OneToMany(targetEntity="Drink", mappedBy="drinkCategory")
     */
    
    private $drinks;


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
     * @return DrinkCategory
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
     * @return DrinkCategory
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
     * Set image
     *
     * @param string $image
     * @return DrinkCategory
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set available
     *
     * @param boolean $available
     * @return DrinkCategory
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
        $this->drinks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set restaurant
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurant
     * @return DrinkCategory
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
     * Add drinks
     *
     * @param \RestaurantBundle\Entity\Drink $drinks
     * @return DrinkCategory
     */
    public function addDrink(\RestaurantBundle\Entity\Drink $drinks)
    {
        $this->drinks[] = $drinks;

        return $this;
    }

    /**
     * Remove drinks
     *
     * @param \RestaurantBundle\Entity\Drink $drinks
     */
    public function removeDrink(\RestaurantBundle\Entity\Drink $drinks)
    {
        $this->drinks->removeElement($drinks);
    }

    /**
     * Get drinks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDrinks()
    {
        return $this->drinks;
    }
}
