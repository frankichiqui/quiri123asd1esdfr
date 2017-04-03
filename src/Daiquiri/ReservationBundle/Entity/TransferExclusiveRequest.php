<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * 
 */
class TransferExclusiveRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\TransferExclusive")
     * @ORM\JoinColumn(name="transfer", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $transfer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pickup_time", type="date")
     */
    private $pickup_time;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Flight", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="flight", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $flight;

    /**
     * @var string
     *
     * @ORM\Column(name="passengers", type="integer")
     */
    private $passengers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    public static function getRootViewFolder() {
        return 'Transfer';
    }

    public function getFullInfo() {
        $tipe = 'INTER';
        if ($this->transfer->getTypeTransfer() == 1) {
            $tipe = 'IN';
        }
        if ($this->transfer->getTypeTransfer() == 2) {
            $tipe = 'OUT';
        }
        if ($tipe == 'INTER') {
            return $tipe . ' PRIVATE TRF(' . $this->transfer . ')for ' . $this->passengers . ' In: ' . $this->startdate->format('M j Y') . ' Time: ' . $this->pickup_time->format('g:i a');
        }
        return $tipe . ' PRIVATE TRF(' . $this->transfer . ') for ' . $this->passengers . ' In: ' . $this->startdate->format('M j Y') . ' Flight: ' . $this->flight;
    }

    /**
     * Set pickupTime
     *
     * @param \DateTime $pickupTime
     *
     * @return TransferExclusiveRequest
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
     * Set passengers
     *
     * @param integer $passengers
     *
     * @return TransferExclusiveRequest
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

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return TransferExclusiveRequest
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
     * Set transfer
     *
     * @param \Daiquiri\AdminBundle\Entity\TransferExclusive $transfer
     *
     * @return TransferExclusiveRequest
     */
    public function setTransfer(\Daiquiri\AdminBundle\Entity\TransferExclusive $transfer = null) {
        $this->transfer = $transfer;

        return $this;
    }

    /**
     * Get transfer
     *
     * @return \Daiquiri\AdminBundle\Entity\TransferExclusive
     */
    public function getTransfer() {
        return $this->transfer;
    }

    /**
     * Set flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     *
     * @return TransferExclusiveRequest
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

}
