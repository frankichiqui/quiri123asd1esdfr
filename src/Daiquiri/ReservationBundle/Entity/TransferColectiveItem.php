<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransferColectiveItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TransferColectiveItem extends CartItem {

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
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Flight", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="flight", referencedColumnName="id")
     */
    private $flight;

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
                $this->product . $this->product->getType() .
                $this->startdate->format('M j, Y') .
                $this->flight .
                $this->pickupplace .
                $this->passengers .
                $this->dropoffplace);
    }

    /**
     * Set passengers
     *
     * @param integer $passengers
     *
     * @return TransferColectiveItem
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
     * Set id
     *
     * @param string $id
     *
     * @return TransferColectiveItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return TransferColectiveItem
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
     * @return TransferColectiveItem
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
     * Set flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     *
     * @return TransferColectiveItem
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

        return $tipe . ' Colective for ' . $this->passengers;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return TransferColectiveItem
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
