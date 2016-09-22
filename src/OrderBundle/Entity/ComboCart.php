<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComboCart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ComboCart
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
     * @ORM\Column(name="idCombo", type="integer")
     */
    private $idCombo;
    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="Comment", type="string", length=255)
     */
    private $comment;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="combosCart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
       
    private $cart;


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
     * Set idCombo
     *
     * @param integer $idCombo
     * @return ComboCart
     */
    public function setIdCombo($idCombo)
    {
        $this->idCombo = $idCombo;

        return $this;
    }

    /**
     * Get idCombo
     *
     * @return integer 
     */
    public function getIdCombo()
    {
        return $this->idCombo;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return ComboCart
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set cart
     *
     * @param \OrderBundle\Entity\Cart $cart
     * @return ComboCart
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
     * Set quantity
     *
     * @param integer $quantity
     * @return ComboCart
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
}
