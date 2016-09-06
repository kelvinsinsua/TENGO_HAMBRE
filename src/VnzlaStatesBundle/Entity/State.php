<?php

namespace VnzlaStatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class State
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
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="iso31662", type="string", length=255)
     */
    private $iso31662;
    
    
     /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="state")
     */
    
    private $cities;
     /**
     * @ORM\OneToMany(targetEntity="Municipalty", mappedBy="state")
     */
    
    private $municipalties;
    
    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="states")
     * @ORM\JoinColumn(name="id_country", referencedColumnName="id")
     */
       
    private $country;

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
     * Set state
     *
     * @param string $state
     * @return State
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set iso31662
     *
     * @param string $iso31662
     * @return State
     */
    public function setIso31662($iso31662)
    {
        $this->iso31662 = $iso31662;

        return $this;
    }

    /**
     * Get iso31662
     *
     * @return string 
     */
    public function getIso31662()
    {
        return $this->iso31662;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->municipalties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cities
     *
     * @param \VnzlaStatesBundle\Entity\City $cities
     * @return State
     */
    public function addCity(\VnzlaStatesBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \VnzlaStatesBundle\Entity\City $cities
     */
    public function removeCity(\VnzlaStatesBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Add municipalties
     *
     * @param \VnzlaStatesBundle\Entity\Municipalty $municipalties
     * @return State
     */
    public function addMunicipalty(\VnzlaStatesBundle\Entity\Municipalty $municipalties)
    {
        $this->municipalties[] = $municipalties;

        return $this;
    }

    /**
     * Remove municipalties
     *
     * @param \VnzlaStatesBundle\Entity\Municipalty $municipalties
     */
    public function removeMunicipalty(\VnzlaStatesBundle\Entity\Municipalty $municipalties)
    {
        $this->municipalties->removeElement($municipalties);
    }

    /**
     * Get municipalties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMunicipalties()
    {
        return $this->municipalties;
    }

    /**
     * Set country
     *
     * @param \VnzlaStatesBundle\Entity\Country $country
     * @return State
     */
    public function setCountry(\VnzlaStatesBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \VnzlaStatesBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
