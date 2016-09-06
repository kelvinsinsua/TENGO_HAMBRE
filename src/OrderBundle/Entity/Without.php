<?php

namespace OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Without
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Without
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
     * @ORM\ManyToOne(targetEntity="Orden", inversedBy="without")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
       
    private $order;


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
     * @return Without
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
     * Set order
     *
     * @param \OrderBundle\Entity\Orden $order
     * @return Without
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
}
