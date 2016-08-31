<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Schedule
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
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finishTime", type="time")
     */
    private $finishTime;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="schedules")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
       
    private $restaurant;


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
     * Set day
     *
     * @param integer $day
     * @return Schedule
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Schedule
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set finishTime
     *
     * @param \DateTime $finishTime
     * @return Schedule
     */
    public function setFinishTime($finishTime)
    {
        $this->finishTime = $finishTime;

        return $this;
    }

    /**
     * Get finishTime
     *
     * @return \DateTime 
     */
    public function getFinishTime()
    {
        return $this->finishTime;
    }

    /**
     * Set restaurant
     *
     * @param \RestaurantBundle\Entity\Restaurant $restaurant
     * @return Schedule
     */
    public function setRestaurant(\RestaurantBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \RestaurantBundle\Entity\Restaurant 
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
