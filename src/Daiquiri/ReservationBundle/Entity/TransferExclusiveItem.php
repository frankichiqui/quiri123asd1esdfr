<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransferExclusiveItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TransferExclusiveItem extends CartItem {

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * 
     * 
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="realid", type="integer")
     * @ORM\Id
     * 
     */
    protected $realid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pickup_time", type="date")
     */
    private $pickup_time;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Flight", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="flight", referencedColumnName="id")
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="pickupplace", referencedColumnName="id")
     */
    private $pickupplace;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="dropoffplace", referencedColumnName="id")
     */
    private $dropoffplace;

    /**
     * @var string
     *
     * @ORM\Column(name="passengers", type="integer")
     */
    private $passengers;

    /**
     * @var front     
     */
    private $front;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->passengers; $i++) {
            $salida[] = 4;
        }
        return $salida;
    }

    public function __construct() {
        parent::__construct();
    }

    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product->getId() .
                $this->product->getType() .
                $this->startdate->format('M j, Y') .
                $this->pickupplace .
                $this->dropoffplace .
                $this->pickup_time->format('g:i a') .
                $this->flight);
    }

    /**
     * Set passengers
     *
     * @param integer $passengers
     *
     * @return TransferExclusiveItem
     */
    public function setPassengers($passengers) {
        $this->passengers = $passengers;

        return $this;
    }

    /**
     * Get passengers
     *
     * @return integer
     */
    public function getPassengers() {
        return $this->passengers;
    }

    public function getTypeTransfer() {
        if ($this->pickupplace->containType('airport')) {
            return 1;
        }
        if ($this->dropoffplace->containType('airport')) {
            return 2;
        }
        return 3;
    }

    public function __toString() {
        return $this->pickupplace . " - " . $this->dropoffplace;
    }

    /**
     * Set pickupTime
     *
     * @param \DateTime $pickupTime
     *
     * @return TransferExclusiveItem
     */
    public function setPickupTime($pickupTime) {
        $this->pickup_time = $pickupTime;

        return $this;
    }

    /**
     * Get pickupTime
     *
     * @return \DateTime
     */
    public function getPickupTime() {
        return $this->pickup_time;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return TransferExclusiveItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     *
     * @return TransferExclusiveItem
     */
    public function setFlight(\Daiquiri\AdminBundle\Entity\Flight $flight = null) {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return \Daiquiri\AdminBundle\Entity\Flight
     */
    public function getFlight() {
        return $this->flight;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return TransferExclusiveItem
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
     * @return TransferExclusiveItem
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

    public function getRootFolder() {
        return 'Transfer';
    }

    public function getSpecifications() {
        $tipe = 'INTER';
        if ($this->getTypeTransfer() == 1) {
            $tipe = 'IN';
        }
        if ($this->getTypeTransfer() == 2) {
            $tipe = 'OUT';
        }

        return $tipe . ' Exclusive for ' . $this->passengers;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return TransferExclusiveItem
     */
    public function setFront($front) {
        $this->front = $front;

        return $this;
    }

    /**
     * Get front
     *
     * @return boolean
     */
    public function getFront() {
        return $this->front;
    }

}
