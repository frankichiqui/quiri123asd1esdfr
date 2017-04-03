<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageRequest
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CarRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Car")
     * @ORM\JoinColumn(name="package", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="pickupplace_id", referencedColumnName="id")
     */
    private $pickupplace;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="dropoffplace_id", referencedColumnName="id")
     */
    private $dropoffplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endtime", type="date")
     */
    private $endtime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starttime", type="date")
     */
    private $starttime;

    public static function getRootViewFolder() {
        return 'Car';
    }

    public function getFullInfo() {
        return 'Car : ' . $this->car .
                ' PickupPlace :' . $this->pickupplace . ' At : ' . $this->startdate->format('M j Y') . $this->starttime->format('g:i a') . ' Dropoffplace:  ' . $this->dropoffplace . ' At: ' . $this->enddate->format('M j Y') . $this->endtime->format('g:i a');
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return CarRequest
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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CarRequest
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
     * Set endtime
     *
     * @param \DateTime $endtime
     *
     * @return CarRequest
     */
    public function setEndtime($endtime) {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return \DateTime
     */
    public function getEndtime() {
        return $this->endtime;
    }

    /**
     * Set starttime
     *
     * @param \DateTime $starttime
     *
     * @return CarRequest
     */
    public function setStarttime($starttime) {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return \DateTime
     */
    public function getStarttime() {
        return $this->starttime;
    }

    /**
     * Set car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return CarRequest
     */
    public function setCar(\Daiquiri\AdminBundle\Entity\Car $car = null) {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \Daiquiri\AdminBundle\Entity\Car
     */
    public function getCar() {
        return $this->car;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return CarRequest
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
     * @return CarRequest
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

}
