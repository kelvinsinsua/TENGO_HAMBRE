<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Client
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gender", type="boolean")
     */
    private $gender;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="city", type="integer")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;
    
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="client")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
       
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Preference", mappedBy="client")
     */
    
    private $preference;
    
    /**
     * @ORM\OneToMany(targetEntity="\OrderBundle\Entity\Orden", mappedBy="client")
     */
    
    private $orders;
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
     * Set firstname
     *
     * @param string $firstname
     * @return Client
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Client
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return Client
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Client
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param integer $city
     * @return Client
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return integer 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Client
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Client
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preference = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add preference
     *
     * @param \UserBundle\Entity\Preference $preference
     * @return Client
     */
    public function addPreference(\UserBundle\Entity\Preference $preference)
    {
        $this->preference[] = $preference;

        return $this;
    }

    /**
     * Remove preference
     *
     * @param \UserBundle\Entity\Preference $preference
     */
    public function removePreference(\UserBundle\Entity\Preference $preference)
    {
        $this->preference->removeElement($preference);
    }

    /**
     * Get preference
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreference()
    {
        return $this->preference;
    }

    /**
     * Add orders
     *
     * @param \OrderBundle\Entity\Order $orders
     * @return Client
     */
    public function addOrder(\OrderBundle\Entity\Orden $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \OrderBundle\Entity\Order $orders
     */
    public function removeOrder(\OrderBundle\Entity\Orden $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
