<?php

namespace RestaurantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReputationPlate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ReputationPlate
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
     * @ORM\Column(name="calification", type="integer")
     */
    private $calification;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @ORM\ManyToOne(targetEntity="Plate", inversedBy="reputations")
     * @ORM\JoinColumn(name="plate_id", referencedColumnName="id")
     */
       
    private $plate;


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
     * Set calification
     *
     * @param integer $calification
     * @return ReputationPlate
     */
    public function setCalification($calification)
    {
        $this->calification = $calification;

        return $this;
    }

    /**
     * Get calification
     *
     * @return integer 
     */
    public function getCalification()
    {
        return $this->calification;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return ReputationPlate
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ReputationPlate
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set plate
     *
     * @param \RestaurantBundle\Entity\Plate $plate
     * @return ReputationPlate
     */
    public function setPlate(\RestaurantBundle\Entity\Plate $plate = null)
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * Get plate
     *
     * @return \RestaurantBundle\Entity\Plate 
     */
    public function getPlate()
    {
        return $this->plate;
    }
}
