<?php

namespace VnzlaStatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipalty
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Municipalty
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
     * @ORM\Column(name="municipalty", type="string", length=255)
     */
    private $municipalty;
    
    
     /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="municipalties")
     * @ORM\JoinColumn(name="id_state", referencedColumnName="id")
     */
       
    private $state;
    
     /**
     * @ORM\OneToMany(targetEntity="Parish", mappedBy="municipalty")
     */
    
    private $parishes;


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
     * Set municipalty
     *
     * @param string $municipalty
     * @return Municipalty
     */
    public function setMunicipalty($municipalty)
    {
        $this->municipalty = $municipalty;

        return $this;
    }

    /**
     * Get municipalty
     *
     * @return string 
     */
    public function getMunicipalty()
    {
        return $this->municipalty;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parishes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set state
     *
     * @param \VnzlaStatesBundle\Entity\State $state
     * @return Municipalty
     */
    public function setState(\VnzlaStatesBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \VnzlaStatesBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add parishes
     *
     * @param \VnzlaStatesBundle\Entity\Parish $parishes
     * @return Municipalty
     */
    public function addParish(\VnzlaStatesBundle\Entity\Parish $parishes)
    {
        $this->parishes[] = $parishes;

        return $this;
    }

    /**
     * Remove parishes
     *
     * @param \VnzlaStatesBundle\Entity\Parish $parishes
     */
    public function removeParish(\VnzlaStatesBundle\Entity\Parish $parishes)
    {
        $this->parishes->removeElement($parishes);
    }

    /**
     * Get parishes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParishes()
    {
        return $this->parishes;
    }
}
