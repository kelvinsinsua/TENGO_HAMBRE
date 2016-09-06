<?php

namespace VnzlaStatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class City
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
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var boolean
     *
     * @ORM\Column(name="capital", type="boolean")
     */
    private $capital;
    
    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="cities")
     * @ORM\JoinColumn(name="id_state", referencedColumnName="id")
     */
       
    private $state;


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
     * Set city
     *
     * @param string $city
     * @return City
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set capital
     *
     * @param boolean $capital
     * @return City
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return boolean 
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set state
     *
     * @param \VnzlaStatesBundle\Entity\State $state
     * @return City
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
}
