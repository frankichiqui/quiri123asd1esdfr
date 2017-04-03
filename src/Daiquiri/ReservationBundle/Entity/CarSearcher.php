<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CarSearcher extends Searcher {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="pickupplace", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $pickupplace;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="dropoffplace", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $dropoffplace;

   

    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer", nullable = true)
     */
    private $capacity;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\LuggageCapacity")
     * @ORM\JoinColumn(name="luggagecapacity", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $luggagecapacity;
    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Car")
     * @ORM\JoinColumn(name="car", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CarCategory")
     * @ORM\JoinColumn(name="luggagecapacity", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CarClass")
     * @ORM\JoinColumn(name="luggagecapacity", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $class;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Driver")
     * @ORM\JoinColumn(name="luggagecapacity", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $driver;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable = true)
     */
    private $title;
   
    

    public function __construct() {
        $this->capacity = -1;
        $this->driver = null;
        $this->dropoffplace = null;
        $this->luggagecapacity = null;
        $this->title = null;
    }

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return CarSearcher
     */
    public function setCapacity($capacity) {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity() {
        return $this->capacity;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CarSearcher
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return CarSearcher
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate() {
        return $this->enddate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CarSearcher
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return CarSearcher
     */
    public function setPickupplace(\Daiquiri\AdminBundle\Entity\Place $pickupplace = null) {
        $this->pickupplace = $pickupplace;

        return $this;
    }

    /**
     * Get pickupplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPickupplace() {
        return $this->pickupplace;
    }

    /**
     * Set dropoffplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $dropoffplace
     *
     * @return CarSearcher
     */
    public function setDropoffplace(\Daiquiri\AdminBundle\Entity\Place $dropoffplace = null) {
        $this->dropoffplace = $dropoffplace;

        return $this;
    }

    /**
     * Get dropoffplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getDropoffplace() {
        return $this->dropoffplace;
    }

    /**
     * Set luggagecapacity
     *
     * @param \Daiquiri\AdminBundle\Entity\LuggageCapacity $luggagecapacity
     *
     * @return CarSearcher
     */
    public function setLuggagecapacity(\Daiquiri\AdminBundle\Entity\LuggageCapacity $luggagecapacity = null) {
        $this->luggagecapacity = $luggagecapacity;

        return $this;
    }

    /**
     * Get luggagecapacity
     *
     * @return \Daiquiri\AdminBundle\Entity\LuggageCapacity
     */
    public function getLuggagecapacity() {
        return $this->luggagecapacity;
    }

    /**
     * Set driver
     *
     * @param \Daiquiri\AdminBundle\Entity\Driver $driver
     *
     * @return CarSearcher
     */
    public function setDriver(\Daiquiri\AdminBundle\Entity\Driver $driver = null) {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Daiquiri\AdminBundle\Entity\Driver
     */
    public function getDriver() {
        return $this->driver;
    }

    /**
     * Set category
     *
     * @param \Daiquiri\AdminBundle\Entity\CarCategory $category
     *
     * @return CarSearcher
     */
    public function setCategory(\Daiquiri\AdminBundle\Entity\CarCategory $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Daiquiri\AdminBundle\Entity\CarCategory
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set class
     *
     * @param \Daiquiri\AdminBundle\Entity\CarClass $class
     *
     * @return CarSearcher
     */
    public function setClass(\Daiquiri\AdminBundle\Entity\CarClass $class = null) {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \Daiquiri\AdminBundle\Entity\CarClass
     */
    public function getClass() {
        return $this->class;
    }

    public function __toString() {
        $return = 'Car';
        if ($this->pickupplace) {
            $return.= ' Pickupplace: ' . $this->pickupplace;
        }
        if ($this->dropoffplace) {
            $return.= ' Dropoffplace: ' . $this->dropoffplace;
        }
        if ($this->startdate) {
            $return.= ' PickupDate: ' . $this->startdate->format('M j, Y g:i a');
        }
        if ($this->enddate) {
            $return.= ' DropoffDate: ' . $this->enddate->format('M j, Y g:i a');
        }
        if ($this->class) {
            $return.= ' with Class: ' . $this->class;
        }
        if ($this->category) {
            $return.= ' with Category: ' . $this->category;
        }
        if ($this->luggagecapacity) {
            $return.= ' with Luggage Capacity: ' . $this->luggagecapacity;
        }
         if ($this->driver) {
            $return.= ' with Driver: ' . $this->driver;
        }
        return $return;
    }


    /**
     * Set car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return CarSearcher
     */
    public function setCar(\Daiquiri\AdminBundle\Entity\Car $car = null)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \Daiquiri\AdminBundle\Entity\Car
     */
    public function getCar()
    {
        return $this->car;
    }
    
    

}
