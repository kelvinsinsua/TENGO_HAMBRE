<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Drink
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Drink
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alcohol", type="boolean")
     */
    private $alcohol;
    
    /**
     * @ORM\ManyToOne(targetEntity="DrinkCategory", inversedBy="drinks")
     * @ORM\JoinColumn(name="drink_category_id", referencedColumnName="id")
     */
       
    private $drinkCategory;

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
     * @return Drink
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
     * @return Drink
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
     * Set description
     *
     * @param string $description
     * @return Drink
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
     * Set alcohol
     *
     * @param boolean $alcohol
     * @return Drink
     */
    public function setAlcohol($alcohol)
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return boolean 
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }

    /**
     * Set drinkCategory
     *
     * @param \RestaurantBundle\Entity\DrinkCategory $drinkCategory
     * @return Drink
     */
    public function setDrinkCategory(\RestaurantBundle\Entity\DrinkCategory $drinkCategory = null)
    {
        $this->drinkCategory = $drinkCategory;

        return $this;
    }

    /**
     * Get drinkCategory
     *
     * @return \RestaurantBundle\Entity\DrinkCategory 
     */
    public function getDrinkCategory()
    {
        return $this->drinkCategory;
    }
}
