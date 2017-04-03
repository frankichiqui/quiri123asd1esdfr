<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OcupationItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OcupationItem extends CartItem {

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
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="hotel", referencedColumnName="id")
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Room", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="room", referencedColumnName="id")
     */
    private $room;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var front     
     */
    private $front;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->adults; $i++) {
            $salida[] = 1;
        }
        for ($i = 0; $i < $this->quantity * $this->kids; $i++) {
            $salida[] = 2;
        }
        for ($i = 0; $i < $this->quantity * $this->infants; $i++) {
            $salida[] = 3;
        }
        return $salida;
        //  return array('adults' => $this->quantity * $this->adults, 'kids' => $this->quantity * $this->kids, 'infants' => $this->quantity * $this->infants);
    }

    /**
     * @var string
     *
     * @ORM\Column(name="plan", type="string", length=255)
     */
    private $plan;

    /**
     * @var integer
     *
     * @ORM\Column(name="infant", type="integer")
     */
    private $infants;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * Set plan
     *
     * @param string $plan
     *
     * @return OcupationItem
     */
    public function setPlan($plan) {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string
     */
    public function getPlan() {
        return $this->plan;
    }

    /**
     * Set infants
     *
     * @param integer $infants
     *
     * @return OcupationItem
     */
    public function setInfants($infants) {
        $this->infants = $infants;

        return $this;
    }

    /**
     * Get infants
     *
     * @return integer
     */
    public function getInfants() {
        return $this->infants;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return OcupationItem
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
     * Set kids
     *
     * @param integer $kids
     *
     * @return OcupationItem
     */
    public function setKids($kids) {
        $this->kids = $kids;

        return $this;
    }

    /**
     * Get kids
     *
     * @return integer
     */
    public function getKids() {
        return $this->kids;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return OcupationItem
     */
    public function setAdults($adults) {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults() {
        return $this->adults;
    }

    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product .
                $this->startdate->format("M j, Y") .
                $this->enddate->format("M j, Y") .
                $this->room .
                $this->hotel .
                $this->plan .
                $this->kids .
                $this->adults .
                $this->infants
        );
    }

    public function __construct() {
        parent::__construct();
    }

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return OcupationItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return OcupationItem
     */
    public function setHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel = null) {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Daiquiri\AdminBundle\Entity\Hotel
     */
    public function getHotel() {
        return $this->hotel;
    }

    /**
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return OcupationItem
     */
    public function setRoom(\Daiquiri\AdminBundle\Entity\Room $room = null) {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Daiquiri\AdminBundle\Entity\Room
     */
    public function getRoom() {
        return $this->room;
    }

    public function getRootFolder() {
        return 'Hotel';
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return OcupationItem
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
