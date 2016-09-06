<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AditionalItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AditionalItem
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
     * @var integer
     *
     * @ORM\Column(name="quiantity", type="integer")
     */
    private $quiantity;
    
    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="aditionalItems")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
       
    private $item;


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
     * @return AditionalItem
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
     * @return AditionalItem
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
     * Set quiantity
     *
     * @param integer $quiantity
     * @return AditionalItem
     */
    public function setQuiantity($quiantity)
    {
        $this->quiantity = $quiantity;

        return $this;
    }

    /**
     * Get quiantity
     *
     * @return integer 
     */
    public function getQuiantity()
    {
        return $this->quiantity;
    }

    

    /**
     * Set item
     *
     * @param \OrderBundle\Entity\Item $item
     * @return AditionalItem
     */
    public function setItem(\OrderBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \OrderBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}
