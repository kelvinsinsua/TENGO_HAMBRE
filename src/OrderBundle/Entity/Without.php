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
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="without")
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
     * Set item
     *
     * @param \OrderBundle\Entity\Item $item
     * @return Without
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
