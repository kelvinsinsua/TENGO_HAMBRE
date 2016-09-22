<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cart
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
     * @ORM\Column(name="description", type="string", length=255, nullable = true)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="idRestaurant", type="integer")
     */
    private $idRestaurant;
    
    /**
     * @var float
     *
     * @ORM\Column( type="float")
     */
    private $total;
    
    /**
     * @ORM\OneToOne(targetEntity="\UserBundle\Entity\Client", inversedBy="cart")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
       
    private $client;
    
    /**
     * @ORM\OneToMany(targetEntity="PlateCart", mappedBy="cart")
     */
    
    private $platesCart;
    /**
     * @ORM\OneToMany(targetEntity="ComboCart", mappedBy="cart")
     */
    
    private $combosCart;


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
     * Set description
     *
     * @param string $description
     * @return Cart
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
     * Constructor
     */
    public function __construct()
    {
        $this->platesCart = new \Doctrine\Common\Collections\ArrayCollection();
        $this->combosCart = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set client
     *
     * @param \UserBundle\Entity\Client $client
     * @return Cart
     */
    public function setClient(\UserBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \UserBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add platesCart
     *
     * @param \OrderBundle\Entity\PlateCart $platesCart
     * @return Cart
     */
    public function addPlatesCart(\OrderBundle\Entity\PlateCart $platesCart)
    {
        $this->platesCart[] = $platesCart;

        return $this;
    }

    /**
     * Remove platesCart
     *
     * @param \OrderBundle\Entity\PlateCart $platesCart
     */
    public function removePlatesCart(\OrderBundle\Entity\PlateCart $platesCart)
    {
        $this->platesCart->removeElement($platesCart);
    }

    /**
     * Get platesCart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlatesCart()
    {
        return $this->platesCart;
    }

    /**
     * Add combosCart
     *
     * @param \OrderBundle\Entity\ComboCart $combosCart
     * @return Cart
     */
    public function addCombosCart(\OrderBundle\Entity\ComboCart $combosCart)
    {
        $this->combosCart[] = $combosCart;

        return $this;
    }

    /**
     * Remove combosCart
     *
     * @param \OrderBundle\Entity\ComboCart $combosCart
     */
    public function removeCombosCart(\OrderBundle\Entity\ComboCart $combosCart)
    {
        $this->combosCart->removeElement($combosCart);
    }

    /**
     * Get combosCart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCombosCart()
    {
        return $this->combosCart;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Cart
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
     * Set idRestaurant
     *
     * @param integer $idRestaurant
     * @return Cart
     */
    public function setIdRestaurant($idRestaurant)
    {
        $this->idRestaurant = $idRestaurant;

        return $this;
    }

    /**
     * Get idRestaurant
     *
     * @return integer 
     */
    public function getIdRestaurant()
    {
        return $this->idRestaurant;
    }
}
