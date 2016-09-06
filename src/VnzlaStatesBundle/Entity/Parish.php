<?php

namespace VnzlaStatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parish
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Parish
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
     * @ORM\Column(name="parish", type="string", length=255)
     */
    private $parish;
    
    /**
     * @ORM\ManyToOne(targetEntity="Municipalty", inversedBy="parishes")
     * @ORM\JoinColumn(name="id_municipalty", referencedColumnName="id")
     */
       
    private $municipalty;


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
     * Set parish
     *
     * @param string $parish
     * @return Parish
     */
    public function setParish($parish)
    {
        $this->parish = $parish;

        return $this;
    }

    /**
     * Get parish
     *
     * @return string 
     */
    public function getParish()
    {
        return $this->parish;
    }

    /**
     * Set municipalty
     *
     * @param \VnzlaStatesBundle\Entity\Municipalty $municipalty
     * @return Parish
     */
    public function setMunicipalty(\VnzlaStatesBundle\Entity\Municipalty $municipalty = null)
    {
        $this->municipalty = $municipalty;

        return $this;
    }

    /**
     * Get municipalty
     *
     * @return \VnzlaStatesBundle\Entity\Municipalty 
     */
    public function getMunicipalty()
    {
        return $this->municipalty;
    }
}
