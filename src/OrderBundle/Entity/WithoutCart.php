<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WithoutCart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WithoutCart
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
     * @ORM\Column(name="idWithout", type="integer")
     */
    private $idWithout;
    
    /**
     * @ORM\ManyToOne(targetEntity="PlateCart", inversedBy="withoutsCart")
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
     * Set idWithout
     *
     * @param integer $idWithout
     * @return WithoutCart
     */
    public function setIdWithout($idWithout)
    {
        $this->idWithout = $idWithout;

        return $this;
    }

    /**
     * Get idWithout
     *
     * @return integer 
     */
    public function getIdWithout()
    {
        return $this->idWithout;
    }

    /**
     * Set plateCart
     *
     * @param \OrderBundle\Entity\PlateCart $plateCart
     * @return WithoutCart
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
