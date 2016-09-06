<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preference
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Preference
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
     * @ORM\Column(name="idCategory", type="integer")
     */
    private $idCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="preferences")
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
     * Set idCategory
     *
     * @param integer $idCategory
     * @return Preference
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return integer 
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Preference
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
     * Set client
     *
     * @param \UserBundle\Entity\Client $client
     * @return Preference
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
