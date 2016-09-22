<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlateCart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PlateCart
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
     * @var integer
     *
     * @ORM\Column(name="idPlate", type="integer")
     */
    private $idPlate;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="platesCart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
       
    private $cart;
    
     /**
     * @ORM\OneToMany(targetEntity="WithoutCart", mappedBy="plateCart")
     */
    
    private $withoutsCart;
    /**
     * @ORM\OneToMany(targetEntity="AditionalItemCart", mappedBy="plateCart")
     */
    
    private $aditionalItemsCart;

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
     * Set idPlate
     *
     * @param integer $idPlate
     * @return PlateCart
     */
    public function setIdPlate($idPlate)
    {
        $this->idPlate = $idPlate;

        return $this;
    }

    /**
     * Get idPlate
     *
     * @return integer 
     */
    public function getIdPlate()
    {
        return $this->idPlate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->withoutsCart = new \Doctrine\Common\Collections\ArrayCollection();
        $this->aditionalItemsCart = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cart
     *
     * @param \OrderBundle\Entity\Cart $cart
     * @return PlateCart
     */
    public function setCart(\OrderBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \OrderBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add withoutsCart
     *
     * @param \OrderBundle\Entity\WithoutCart $withoutsCart
     * @return PlateCart
     */
    public function addWithoutsCart(\OrderBundle\Entity\WithoutCart $withoutsCart)
    {
        $this->withoutsCart[] = $withoutsCart;

        return $this;
    }

    /**
     * Remove withoutsCart
     *
     * @param \OrderBundle\Entity\WithoutCart $withoutsCart
     */
    public function removeWithoutsCart(\OrderBundle\Entity\WithoutCart $withoutsCart)
    {
        $this->withoutsCart->removeElement($withoutsCart);
    }

    /**
     * Get withoutsCart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWithoutsCart()
    {
        return $this->withoutsCart;
    }

    /**
     * Add aditionalItemsCart
     *
     * @param \OrderBundle\Entity\AditionalItemCart $aditionalItemsCart
     * @return PlateCart
     */
    public function addAditionalItemsCart(\OrderBundle\Entity\AditionalItemCart $aditionalItemsCart)
    {
        $this->aditionalItemsCart[] = $aditionalItemsCart;

        return $this;
    }

    /**
     * Remove aditionalItemsCart
     *
     * @param \OrderBundle\Entity\AditionalItemCart $aditionalItemsCart
     */
    public function removeAditionalItemsCart(\OrderBundle\Entity\AditionalItemCart $aditionalItemsCart)
    {
        $this->aditionalItemsCart->removeElement($aditionalItemsCart);
    }

    /**
     * Get aditionalItemsCart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAditionalItemsCart()
    {
        return $this->aditionalItemsCart;
    }
}
