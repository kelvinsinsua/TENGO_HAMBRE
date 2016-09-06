<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Item
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
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Orden", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
       
    private $order;
    
    /**
     * @ORM\OneToMany(targetEntity="Without", mappedBy="item")
     */
    
    private $without;
    /**
     * @ORM\OneToMany(targetEntity="AditionalItem", mappedBy="item")
     */
    
    private $aditionalItems;


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
     * @return Item
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
     * Set quantity
     *
     * @param integer $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Item
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
     * Set order
     *
     * @param \OrderBundle\Entity\Orden $order
     * @return Item
     */
    public function setOrder(\OrderBundle\Entity\Orden $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \OrderBundle\Entity\Orden 
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->without = new \Doctrine\Common\Collections\ArrayCollection();
        $this->aditionalItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add without
     *
     * @param \OrderBundle\Entity\Without $without
     * @return Item
     */
    public function addWithout(\OrderBundle\Entity\Without $without)
    {
        $this->without[] = $without;

        return $this;
    }

    /**
     * Remove without
     *
     * @param \OrderBundle\Entity\Without $without
     */
    public function removeWithout(\OrderBundle\Entity\Without $without)
    {
        $this->without->removeElement($without);
    }

    /**
     * Get without
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWithout()
    {
        return $this->without;
    }

    /**
     * Add aditionalItems
     *
     * @param \OrderBundle\Entity\AditionalItem $aditionalItems
     * @return Item
     */
    public function addAditionalItem(\OrderBundle\Entity\AditionalItem $aditionalItems)
    {
        $this->aditionalItems[] = $aditionalItems;

        return $this;
    }

    /**
     * Remove aditionalItems
     *
     * @param \OrderBundle\Entity\AditionalItem $aditionalItems
     */
    public function removeAditionalItem(\OrderBundle\Entity\AditionalItem $aditionalItems)
    {
        $this->aditionalItems->removeElement($aditionalItems);
    }

    /**
     * Get aditionalItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAditionalItems()
    {
        return $this->aditionalItems;
    }
}
