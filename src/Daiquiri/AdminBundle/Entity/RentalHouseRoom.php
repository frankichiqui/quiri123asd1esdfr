<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalHouseRoom
 *
 * @ORM\Table(name="rental_house_room")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseRoomRepository")
 */
class RentalHouseRoom extends Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility", inversedBy="rental_house_rooms")
     * @ORM\JoinTable(name="rental_house_room_rental_house_room_facilities")
     */
    private $rental_house_room_facilities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupation", inversedBy="rental_house_rooms")
     * @ORM\JoinTable(name="rental_house_room_rental_house_room_ocupations")
     */
    private $rental_house_room_ocupations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability", mappedBy="rental_house_room", cascade={"persist","refresh"})
     */
    private $rental_house_room_availabilities;

    /**
     * @var \Daiquiri\AdminBundle\Entity\RentalHouse
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", inversedBy="rental_house_rooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rental_house", referencedColumnName="id")
     * })
     */
    private $rental_house;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     *  @ORM\ManyToMany(targetEntity="CampaignRentalHouse", inversedBy="rentalhouserooms")
     *  @ORM\JoinTable(name="campaignrantalhouses_rentalhouserooms")
     */
    private $campaigns;

    /**
     * Constructor
     */
    public function __construct() {
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();

        $this->rental_house_room_facilities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rental_house_room_ocupations = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return RentalHouseRoom
     */
    public function setPrice($price) {
        $this->price = $price;


        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getRentalHouse() {
        return $this->rental_house;
    }

    /**
     * Add rentalHouseRoomFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $rentalHouseRoomFacility
     *
     * @return RentalHouseRoom
     */
    public function addRentalHouseRoomFacility(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $rentalHouseRoomFacility) {
        $this->rental_house_room_facilities[] = $rentalHouseRoomFacility;

        return $this;
    }

    /**
     * Remove rentalHouseRoomFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $rentalHouseRoomFacility
     */
    public function removeRentalHouseRoomFacility(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $rentalHouseRoomFacility) {
        $this->rental_house_room_facilities->removeElement($rentalHouseRoomFacility);
    }

    /**
     * Get rentalHouseRoomFacilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseRoomFacilities() {
        return $this->rental_house_room_facilities;
    }

    /**
     * Add rentalHouseRoomOcupation
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupation $rentalHouseRoomOcupation
     *
     * @return RentalHouseRoom
     */
    public function addRentalHouseRoomOcupation(\Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupation $rentalHouseRoomOcupation) {
        $this->rental_house_room_ocupations[] = $rentalHouseRoomOcupation;

        return $this;
    }

    /**
     * Remove rentalHouseRoomOcupation
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupation $rentalHouseRoomOcupation
     */
    public function removeRentalHouseRoomOcupation(\Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupation $rentalHouseRoomOcupation) {
        $this->rental_house_room_ocupations->removeElement($rentalHouseRoomOcupation);
    }

    /**
     * Get rentalHouseRoomOcupations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseRoomOcupations() {
        return $this->rental_house_room_ocupations;
    }

    /**
     * Add rentalHouseRoomAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability $rentalHouseRoomAvailability
     *
     * @return RentalHouseRoom
     */
    public function addRentalHouseRoomAvailability(\Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability $rentalHouseRoomAvailability) {
        $rentalHouseRoomAvailability->setRentalHouseRoom($this);
        $this->rental_house_room_availabilities[] = $rentalHouseRoomAvailability;

        return $this;
    }

    /**
     * Remove rentalHouseRoomAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability $rentalHouseRoomAvailability
     */
    public function removeRentalHouseRoomAvailability(\Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability $rentalHouseRoomAvailability) {
        $rentalHouseRoomAvailability->setRentalHouseRoom(null);
        $this->rental_house_room_availabilities->removeElement($rentalHouseRoomAvailability);
    }

    /**
     * Get rentalHouseRoomAvailabilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseRoomAvailabilities() {
        return $this->rental_house_room_availabilities;
    }

    public function setRentalHouseRoomAvailabilities(\Doctrine\Common\Collections\Collection $rentalhouseroomavailabilities = null) {
        if (count($rentalhouseroomavailabilities) > 0) {
            foreach ($rentalhouseroomavailabilities as $item) {
                $this->addRentalHouseRoomAvailability($item);
            }
        }
        return $this;
    }

    /**
     * Set rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     *
     * @return RentalHouseRoom
     */
    public function setRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse = null) {
        $this->rental_house = $rentalHouse;


        return $this;
    }

    public function isAvailableInDate(\DateTime $date) {
        if (count($this->rental_house_room_availabilities) > 0) {
            foreach ($this->rental_house_room_availabilities as $av) {
                if ($date->format("M j, Y") == $av->getDate()->format("M j, Y")) {
//                    print $date->format("Y-m-d"). '==' .$av->getDate()->format("Y-m-d");
//                    dump($date->format("Y-m-d") == $av->getDate()->format("Y-m-d"));die;
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function isAvailableInDateRange(\DateTime $startdate, \DateTime $enddate) {
        if ($startdate < $enddate) {
            $interval = new \DateInterval('P1D');
            $daterange = new \DatePeriod($startdate, $interval, $enddate->modify('+1 day'));
            foreach ($daterange as $date) {
                if (!$this->isAvailableInDate($date)) {
                    $enddate->modify('-1 day');
                    return false;
                }
            }
        } else {
            $enddate->modify('-1 day');
            return false;
        }
        $enddate->modify('-1 day');
        return true;
    }

    public function isAvailableForOcupation($adult, $kid) {
        if (count($this->getRentalHouseRoomOcupations()) > 0) {
            foreach ($this->getRentalHouseRoomOcupations() as $o) {
                if ($o->getAdult() >= $adult && $o->getKid() >= $kid) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    public function getDiffDays(\DateTime $startdate, \DateTime $enddate) {

        $interval = $startdate->diff($enddate);
        return $interval->format('%d');
    }

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->campaigns as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                return $c;
            }
        }
        return null;
    }

    public $current_offert;

    public function getPrice(\Daiquiri\ReservationBundle\Entity\RentalHouseRoomItem $item = null, Market $m = null) {
        if (!$item || !$m) {
            return $this->price;
        }
        return $this->getTotalPrice($item->getStartdate(), $item->getEnddate(), $m);
    }

    public function rentalhouseroomtitle() {

        return $this->getTitle();
    }

    public function getTotalPrice(\DateTime $startdate, \DateTime $enddate, Market $market) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($startdate, $interval, $enddate);
        $suma = 0;
        foreach ($daterange as $date) {

            $c = $this->getCampaignForDate($date, $market);
            if ($c) {
                $this->current_offert = $c;
                $suma += $this->price - $c->getRoomdiscount();
            } else {
                $suma+=$this->price;
            }
            //  dump($suma);
        }
        return $suma * (1 + $increment);
    }

    public function hasFacility(RentalHouseRoomFacility $f) {
        return $this->rental_house_room_facilities->contains($f);
    }

    public function hasFacilitys($facilities = null) {

        if (!$facilities || $facilities->isEmpty()) {

            return true;
        }
        if ($this->rental_house_room_facilities->isEmpty()) {
            return false;
        }
        foreach ($facilities as $f) {
            if (!$this->hasFacility($f)) {
                return false;
            }
        }
        return true;
    }

    public function allowOcupation($adults, $kids) {
        if ($this->rental_house_room_ocupations->isEmpty()) {
            return false;
        }
        if (($adults == null && $kids == null) || ($adults < 0 && $kids < 0)) {
            return false;
        }
        foreach ($this->rental_house_room_ocupations as $o) {
            if ($o->getAdult() >= $adults && $o->getKid() >= $kids) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return RentalHouse
     */
    public function setAvailable($available) {
        if ($this->rental_house)
            $this->rental_house->setAvailable($available);

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        if ($this->rental_house)
            return $this->rental_house->getAvailable();
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return RentalHouse
     */
    public function setPriority($priority) {
        if ($this->rental_house)
            $this->rental_house->setPriority($priority);

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority() {
        if ($this->rental_house)
            return $this->rental_house->getPriority();
    }

    /**
     * Set payonline
     *
     * @param boolean $payonline
     *
     * @return RentalHouse
     */
    public function setPayonline($payonline) {
        if ($this->rental_house)
            $this->rental_house->setPayonline($payonline);

        return $this;
    }

    /**
     * Get payonline
     *
     * @return boolean
     */
    public function getPayonline() {
        if ($this->rental_house)
            return $this->rental_house->getPayonline();
    }

   

   

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return RentalHouse
     */
    public function setRemarks($remarks) {
        if ($this->rental_house)
            $this->rental_house->setRemarks($remarks);

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks() {
        if ($this->rental_house)
            return $this->rental_house->getRemarks();
    }

    /**
     * Set termConditionHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse
     *
     * @return RentalHouse
     */
    public function setTermConditionHouse(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse = null) {
        if ($this->rental_house)
            $this->rental_house->setTermConditionHouse($termConditionHouse);

        return $this;
    }

    /**
     * Get termConditionHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionHouse() {
        if ($this->rental_house)
            return $this->rental_house->getTermConditionHouse();
    }

    /**
     * Set cancelationHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse
     *
     * @return RentalHouse
     */
    public function setCancelationHouse(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse = null) {
        if ($this->rental_house)
            $this->rental_house->setCancelationHouse($cancelationHouse);

        return $this;
    }

    /**
     * Get cancelationHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationHouse() {
        if ($this->rental_house)
            return $this->rental_house->getCancelationHouse();
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return RentalHouse
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        if ($this->rental_house)
            $this->rental_house->addDocument($document);

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        if ($this->rental_house)
            $this->rental_house->removeDocument($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments() {
        if ($this->rental_house)
            return $this->rental_house->getDocuments();
    }

    public function setProductIncrement(\Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement = null) {
        if ($this->rental_house) {
            $this->rental_house->setProductIncrement($productIncrement);
        }

        return $this;
    }

    public function getProductIncrement() {
        if ($this->rental_house) {
            return $this->rental_house->getProductIncrement();
        }
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignRentalHouse $campaign
     *
     * @return RentalHouseRoom
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignRentalHouse $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignRentalHouse $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignRentalHouse $campaign) {
        $this->campaigns->removeElement($campaign);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampaigns() {
        return $this->campaigns;
    }

    public function getFromprice() {
        return $this->price;
    }

}
