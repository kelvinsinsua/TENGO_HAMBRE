<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Combo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Combo
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
     * @ORM\Column(name="total", type="float")
     */
    private $total;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="combos")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
       
    private $restaurant;
    
     /**
     * @ORM\ManyToMany(targetEntity="Plate", inversedBy="combos")
     * @ORM\JoinTable(name="combos_plates")
     */
    protected $plates;
     /**
     * @ORM\ManyToMany(targetEntity="Drink", inversedBy="combos")
     * @ORM\JoinTable(name="combos_drinks")
     */
    protected $drinks;


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
     * @return Combo
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
     * Set total
     *
     * @param float $total
     * @return Combo
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
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
     * @return Combo
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
     * @return Combo
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

    /**
     * Add drinks
     *
     * @param \RestaurantBundle\Entity\Drink $drinks
     * @return Combo
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
