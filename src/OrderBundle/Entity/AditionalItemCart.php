<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AditionalItemCart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AditionalItemCart
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
     * @ORM\Column(name="idAditionalItem", type="integer")
     */
    private $idAditionalItem;
    
    /**
     * @ORM\ManyToOne(targetEntity="PlateCart", inversedBy="aditionalItemsCart")
     * @ORM\JoinColumn(name="plate_cart_id", referencedColumnName="id")
     */
       
    private $plateCart;


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
     * Set idAditionalItem
     *
     * @param integer $idAditionalItem
     * @return AditionalItemCart
     */
    public function setIdAditionalItem($idAditionalItem)
    {
        $this->idAditionalItem = $idAditionalItem;

        return $this;
    }

    /**
     * Get idAditionalItem
     *
     * @return integer 
     */
    public function getIdAditionalItem()
    {
        return $this->idAditionalItem;
    }

    /**
     * Set plateCart
     *
     * @param \OrderBundle\Entity\PlateCart $plateCart
     * @return AditionalItemCart
     */
    public function setPlateCart(\OrderBundle\Entity\PlateCart $plateCart = null)
    {
        $this->plateCart = $plateCart;

        return $this;
    }

    /**
     * Get plateCart
     *
     * @return \OrderBundle\Entity\PlateCart 
     */
    public function getPlateCart()
    {
        return $this->plateCart;
    }
}
