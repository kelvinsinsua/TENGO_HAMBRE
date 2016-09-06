<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orden
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Orden
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="restaurantId", type="integer")
     */
    private $restaurantId;

    /**
     * @var float
     *
     * @ORM\Column(name="subTotal", type="float")
     */
    private $subTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;
    
    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="order")
     */
    
    private $items;
    /**
     * @ORM\OneToMany(targetEntity="Without", mappedBy="order")
     */
    
    private $without;
    /**
     * @ORM\OneToMany(targetEntity="AditionalItem", mappedBy="order")
     */
    
    private $aditionalItems;
    
    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\Client", inversedBy="orders")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
       
    private $client;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Orden
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set restaurantId
     *
     * @param integer $restaurantId
     * @return Orden
     */
    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    /**
     * Get restaurantId
     *
     * @return integer 
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * Set subTotal
     *
     * @param float $subTotal
     * @return Orden
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get subTotal
     *
     * @return float 
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Orden
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
     * Set description
     *
     * @param string $description
     * @return Orden
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
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->without = new \Doctrine\Common\Collections\ArrayCollection();
        $this->aditionalItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Orden
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add items
     *
     * @param \OrderBundle\Entity\Item $items
     * @return Orden
     */
    public function addItem(\OrderBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \OrderBundle\Entity\Item $items
     */
    public function removeItem(\OrderBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add without
     *
     * @param \OrderBundle\Entity\Without $without
     * @return Orden
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
     * @return Orden
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

    /**
     * Set client
     *
     * @param \UserBundle\Entity\Client $client
     * @return Orden
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
}
