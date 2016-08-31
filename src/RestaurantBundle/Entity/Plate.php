<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Plate
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="plates")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     */
       
    private $menu;
    
    /**
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="plate")
     */
    
    private $ingredients;


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
     * @return Plate
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
     * Set description
     *
     * @param string $description
     * @return Plate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set available
     *
     * @param boolean $available
     * @return Plate
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
     * Set image
     *
     * @param string $image
     * @return Plate
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
     * Set price
     *
     * @param float $price
     * @return Plate
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
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set menu
     *
     * @param \RestaurantBundle\Entity\Menu $menu
     * @return Plate
     */
    public function setMenu(\RestaurantBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \RestaurantBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add ingredients
     *
     * @param \RestaurantBundle\Entity\Ingredient $ingredients
     * @return Plate
     */
    public function addIngredient(\RestaurantBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \RestaurantBundle\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\RestaurantBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}
