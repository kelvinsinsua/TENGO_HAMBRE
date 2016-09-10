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
     * @var float
     *
     * @ORM\Column(name="reputationTotal", type="float")
     */
    private $reputationTotal;
    
    /**
     * @ORM\ManyToMany(targetEntity="Menu", inversedBy="plates")
     * @ORM\JoinTable(name="menu_plate")
     */
    protected $menus;
    
    /**
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="plate")
     */
    
    private $ingredients;
    /**
     * @ORM\OneToMany(targetEntity="ReputationPlate", mappedBy="plate")
     */
    
    private $reputations;
    
    /**
     * @ORM\ManyToMany(targetEntity="Aditional", inversedBy="plates")
     * @ORM\JoinTable(name="plates_aditionals")
     */
    protected $aditionals;
    
    /**
     * @ORM\ManyToMany(targetEntity="Combo", mappedBy="plates")
     */
     private $combos;
    
    


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

    /**
     * Add menus
     *
     * @param \RestaurantBundle\Entity\Menu $menus
     * @return Plate
     */
    public function addMenu(\RestaurantBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;

        return $this;
    }

    /**
     * Remove menus
     *
     * @param \RestaurantBundle\Entity\Menu $menus
     */
    public function removeMenu(\RestaurantBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Add aditionals
     *
     * @param \RestaurantBundle\Entity\Aditional $aditionals
     * @return Plate
     */
    public function addAditional(\RestaurantBundle\Entity\Aditional $aditionals)
    {
        $this->aditionals[] = $aditionals;

        return $this;
    }

    /**
     * Remove aditionals
     *
     * @param \RestaurantBundle\Entity\Aditional $aditionals
     */
    public function removeAditional(\RestaurantBundle\Entity\Aditional $aditionals)
    {
        $this->aditionals->removeElement($aditionals);
    }

    /**
     * Get aditionals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAditionals()
    {
        return $this->aditionals;
    }
    
    /**
     * 
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setAditionals(array $aditionals)
    {
        $this->aditionals = array();

        foreach ($aditionals as $aditional) {
            $this->addAditional($aditional);
        }

        return $this;
    }

    /**
     * Set reputationTotal
     *
     * @param float $reputationTotal
     * @return Plate
     */
    public function setReputationTotal($reputationTotal)
    {
        $this->reputationTotal = $reputationTotal;

        return $this;
    }

    /**
     * Get reputationTotal
     *
     * @return float 
     */
    public function getReputationTotal()
    {
        return $this->reputationTotal;
    }

    /**
     * Add reputations
     *
     * @param \RestaurantBundle\Entity\ReputationPlate $reputations
     * @return Plate
     */
    public function addReputation(\RestaurantBundle\Entity\ReputationPlate $reputations)
    {
        $this->reputations[] = $reputations;

        return $this;
    }

    /**
     * Remove reputations
     *
     * @param \RestaurantBundle\Entity\ReputationPlate $reputations
     */
    public function removeReputation(\RestaurantBundle\Entity\ReputationPlate $reputations)
    {
        $this->reputations->removeElement($reputations);
    }

    /**
     * Get reputations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReputations()
    {
        return $this->reputations;
    }
    /**
     * Get reputations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRestaurant()
    {
        return $this->getMenus()[0]->getRestaurant();
    }

    /**
     * Add combos
     *
     * @param \RestaurantBundle\Entity\Combo $combos
     * @return Plate
     */
    public function addCombo(\RestaurantBundle\Entity\Combo $combos)
    {
        $this->combos[] = $combos;

        return $this;
    }

    /**
     * Remove combos
     *
     * @param \RestaurantBundle\Entity\Combo $combos
     */
    public function removeCombo(\RestaurantBundle\Entity\Combo $combos)
    {
        $this->combos->removeElement($combos);
    }

    /**
     * Get combos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCombos()
    {
        return $this->combos;
    }
}
