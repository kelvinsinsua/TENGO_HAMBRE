<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Restaurant
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="integer", nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="integer", nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=255, nullable=true)
     */
    private $rif;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="string", length=255, nullable=true)
     */
    private $about;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingWindow", type="string", length=255, nullable=true)
     */
    private $bookingWindow;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255, nullable=true)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="string", length=255, nullable=true)
     */
    private $lon;
    
    /**
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="restaurant")
     */
    
    private $menus;
    /**
     * @ORM\OneToMany(targetEntity="Schedule", mappedBy="restaurant")
     */
    
    private $schedules;
    /**
     * @ORM\OneToMany(targetEntity="Aditional", mappedBy="restaurant")
     */
    
    private $aditionals;
    /**
     * @ORM\OneToMany(targetEntity="DrinkCategory", mappedBy="restaurant")
     */
    
    private $drinkCategories;
    
    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="restaurant")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
       
    private $user;
    
    /**
     * @ORM\ManyToMany(targetEntity="\ParametersBundle\Entity\Amenity", inversedBy="restaurants")
     * @ORM\JoinTable(name="studios_amenities")
     */
    protected $amenities;

    
    public function getLocation()
    {
        if($this->getLat()!=null){
        return (string)($this->getLat().','.$this->getLon());
        }
    }
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
     * @return Restaurant
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
     * Set address
     *
     * @param string $address
     * @return Restaurant
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    

    /**
     * Set phone
     *
     * @param string $phone
     * @return Restaurant
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
     * Set rif
     *
     * @param string $rif
     * @return Restaurant
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string 
     */
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Restaurant
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Restaurant
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return Restaurant
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Restaurant
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Restaurant
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Restaurant
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set bookingWindow
     *
     * @param string $bookingWindow
     * @return Restaurant
     */
    public function setBookingWindow($bookingWindow)
    {
        $this->bookingWindow = $bookingWindow;

        return $this;
    }

    /**
     * Get bookingWindow
     *
     * @return string 
     */
    public function getBookingWindow()
    {
        return $this->bookingWindow;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return Restaurant
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param string $lon
     * @return Restaurant
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return string 
     */
    public function getLon()
    {
        return $this->lon;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menus
     *
     * @param \RestaurantBundle\Entity\Menu $menus
     * @return Restaurant
     */
    public function addMenu(\RestaurantBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;

        return $this;
    }

    /**
     * Remove menus
     *
     * @param \RestaurantBundle\Entity\Menu $menus
     */
    public function removeMenu(\RestaurantBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Restaurant
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
     * Add schedules
     *
     * @param \RestaurantBundle\Entity\Schedule $schedules
     * @return Restaurant
     */
    public function addSchedule(\RestaurantBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \RestaurantBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\RestaurantBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Add aditionals
     *
     * @param \RestaurantBundle\Entity\Aditional $aditionals
     * @return Restaurant
     */
    public function addAditional(\RestaurantBundle\Entity\Aditional $aditionals)
    {
        $this->aditionals[] = $aditionals;

        return $this;
    }

    /**
     * Remove aditionals
     *
     * @param \RestaurantBundle\Entity\Aditional $aditionals
     */
    public function removeAditional(\RestaurantBundle\Entity\Aditional $aditionals)
    {
        $this->aditionals->removeElement($aditionals);
    }

    /**
     * Get aditionals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAditionals()
    {
        return $this->aditionals;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Restaurant
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
     * @return Restaurant
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
     * Add amenities
     *
     * @param \ParametersBundle\Entity\Amenity $amenities
     * @return Restaurant
     */
    public function addAmenity(\ParametersBundle\Entity\Amenity $amenities)
    {
        $this->amenities[] = $amenities;

        return $this;
    }

    /**
     * Remove amenities
     *
     * @param \ParametersBundle\Entity\Amenity $amenities
     */
    public function removeAmenity(\ParametersBundle\Entity\Amenity $amenities)
    {
        $this->amenities->removeElement($amenities);
    }

    /**
     * Get amenities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAmenities()
    {
        return $this->amenities;
    }

    /**
     * Add drinkCategories
     *
     * @param \RestaurantBundle\Entity\DrinkCategory $drinkCategories
     * @return Restaurant
     */
    public function addDrinkCategory(\RestaurantBundle\Entity\DrinkCategory $drinkCategories)
    {
        $this->drinkCategories[] = $drinkCategories;

        return $this;
    }

    /**
     * Remove drinkCategories
     *
     * @param \RestaurantBundle\Entity\DrinkCategory $drinkCategories
     */
    public function removeDrinkCategory(\RestaurantBundle\Entity\DrinkCategory $drinkCategories)
    {
        $this->drinkCategories->removeElement($drinkCategories);
    }

    /**
     * Get drinkCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDrinkCategories()
    {
        return $this->drinkCategories;
    }
}
