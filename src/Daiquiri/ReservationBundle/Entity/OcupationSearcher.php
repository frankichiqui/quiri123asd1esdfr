<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OcupationSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OcupationSearcher extends Searcher {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinColumn(name="polo", referencedColumnName="id", nullable = true)
     */
    private $polo;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Hotel")
     * @ORM\JoinColumn(name="hotel", referencedColumnName="id", nullable = true)
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Chain")
     * @ORM\JoinColumn(name="chain", referencedColumnName="id", nullable = true)
     */
    private $chain;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Room")
     * @ORM\JoinColumn(name="room", referencedColumnName="id", nullable = true)
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Province")
     * @ORM\JoinColumn(name="province", referencedColumnName="id", nullable = true)
     */
    private $province;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\HotelType")
     * @ORM\JoinColumn(name="HotelType", referencedColumnName="id", nullable = true)
     */
    private $HotelType;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseFacilityType")
     * @ORM\JoinTable(name="ocupation_searcher_rental_house_facility_type",
     *      joinColumns={@ORM\JoinColumn(name="ocupation_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="hotel_facility_id", referencedColumnName="id")}
     *      )
     */
    private $facilities;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility")
     * @ORM\JoinTable(name="ocupation_searcher_rental_house_room_facility",
     *      joinColumns={@ORM\JoinColumn(name="ocupation_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="rental_house_room_facility_id", referencedColumnName="id")}
     *      )
     */
    private $facilities_room;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;

    /**
     * @var integer
     *
     * @ORM\Column(name="infants", type="integer")
     */
    private $infants;

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
     * @ORM\Column(name="ubication", type="string", length=255, nullable=true)
     */
    private $ubication;

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return OcupationSearcher
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

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return OcupationSearcher
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
     * Set infants
     *
     * @param integer $infants
     *
     * @return OcupationSearcher
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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return OcupationSearcher
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
     * @return OcupationSearcher
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
     * Set polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     *
     * @return OcupationSearcher
     */
    public function setPolo(\Daiquiri\AdminBundle\Entity\Polo $polo = null) {
        $this->polo = $polo;

        return $this;
    }

    /**
     * Get polo
     *
     * @return \Daiquiri\AdminBundle\Entity\Polo
     */
    public function getPolo() {
        return $this->polo;
    }

    /**
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return OcupationSearcher
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
     * Set chain
     *
     * @param \Daiquiri\AdminBundle\Entity\Chain $chain
     *
     * @return OcupationSearcher
     */
    public function setChain(\Daiquiri\AdminBundle\Entity\Chain $chain = null) {
        $this->chain = $chain;

        return $this;
    }

    /**
     * Get chain
     *
     * @return \Daiquiri\AdminBundle\Entity\Chain
     */
    public function getChain() {
        return $this->chain;
    }

    /**
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return OcupationSearcher
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

    /**
     * Set province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     *
     * @return OcupationSearcher
     */
    public function setProvince(\Daiquiri\AdminBundle\Entity\Province $province = null) {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \Daiquiri\AdminBundle\Entity\Province
     */
    public function getProvince() {
        return $this->province;
    }

    /**
     * Set hotelType
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelType $hotelType
     *
     * @return OcupationSearcher
     */
    public function setHotelType(\Daiquiri\AdminBundle\Entity\HotelType $hotelType = null) {
        $this->HotelType = $hotelType;

        return $this;
    }

    /**
     * Get hotelType
     *
     * @return \Daiquiri\AdminBundle\Entity\HotelType
     */
    public function getHotelType() {
        return $this->HotelType;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->facilities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->facilities_room = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add facility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $facility
     *
     * @return OcupationSearcher
     */
    public function addFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $facility) {
        $this->facilities[] = $facility;

        return $this;
    }

    /**
     * Remove facility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $facility
     */
    public function removeFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $facility) {
        $this->facilities->removeElement($facility);
    }

    /**
     * Get facilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacilities() {
        return $this->facilities;
    }

    /**
     * Add facilitiesRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $facilitiesRoom
     *
     * @return OcupationSearcher
     */
    public function addFacilitiesRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $facilitiesRoom) {
        $this->facilities_room[] = $facilitiesRoom;

        return $this;
    }

    /**
     * Remove facilitiesRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $facilitiesRoom
     */
    public function removeFacilitiesRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $facilitiesRoom) {
        $this->facilities_room->removeElement($facilitiesRoom);
    }

    /**
     * Get facilitiesRoom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacilitiesRoom() {
        return $this->facilities_room;
    }

    public function __toString() {
        $salida = "Find Ocupation in ";
        if ($this->startdate) {
            $salida .= $this->startdate->format('M j, Y');
        }
        if ($this->enddate) {
            $salida .=" - " . $this->enddate->format('M j, Y');
        }
        if ($this->adults) {
            $salida .=" For " . $this->adults . " adult(s)";
        }
        if ($this->kids) {
            $salida .="  " . $this->kids . " kid(s)";
        }
        if ($this->infants) {
            $salida .="  and " . $this->infants . " infant(s)";
        }
        return $salida;
    }

    /**
     * Set ubication
     *
     * @param string $ubication
     *
     * @return OcupationSearcher
     */
    public function setUbication($ubication) {
        $this->ubication = $ubication;

        return $this;
    }

    /**
     * Get ubication
     *
     * @return string
     */
    public function getUbication() {
        return $this->ubication;
    }

}
