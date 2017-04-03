<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalHouseRoomSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RentalHouseRoomSearcher extends Searcher{

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
     * @ORM\JoinColumn(name="polo", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $polo;
    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse")
     * @ORM\JoinColumn(name="rentalhouse", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $rentalhouse;
    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom")
     * @ORM\JoinColumn(name="rentalhouseroom", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $rentalhouseroom;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Province")
     * @ORM\JoinColumn(name="province", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="house", type="string", length=255, nullable=true)
     */
    private $house;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseFacilityType")
     * @ORM\JoinTable(name="rental_house_room_searcher_rental_house_facility_type",
     *      joinColumns={@ORM\JoinColumn(name="rental_house_room_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="rental_house_facility_id", referencedColumnName="id")}
     *      )
     */
    private $facilities;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility")
     * @ORM\JoinTable(name="rental_house_room_searcher_rental_house_room_facility",
     *      joinColumns={@ORM\JoinColumn(name="rental_house_room_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="rental_house_room_facility_id", referencedColumnName="id")}
     *      )
     */
    private $facilities_room;

    /**
     * @var integer
     *
     * @ORM\Column(name="rooms", type="integer", nullable=true)
     */
    private $rooms;

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
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseType")
     * @ORM\JoinTable(name="rentalhouseroomsearcher_type",
     *      joinColumns={@ORM\JoinColumn(name="id_rentalhouseroomsearcher", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_typehouse", referencedColumnName="id")}
     *      )
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="privaterental", type="boolean",nullable=true)
     */
    private $PrivateRental;

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

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%a');
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->facilities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->facilities_room = new \Doctrine\Common\Collections\ArrayCollection();
        $this->type = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set rooms
     *
     * @param integer $rooms
     *
     * @return RentalHouseRoomSearcher
     */
    public function setRooms($rooms) {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * Get rooms
     *
     * @return integer
     */
    public function getRooms() {
        return $this->rooms;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return RentalHouseRoomSearcher
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
     * @return RentalHouseRoomSearcher
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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return RentalHouseRoomSearcher
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
     * @return RentalHouseRoomSearcher
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
     * @return RentalHouseRoomSearcher
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
     * Set province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     *
     * @return RentalHouseRoomSearcher
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
     * Add facility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $facility
     *
     * @return RentalHouseRoomSearcher
     */
    public function addFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $facility) {
        $this->facilities[] = $facility;

        return $this;
    }

    /**
     * Remove facility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $facility
     */
    public function removeFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $facility) {
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
     * Set house
     *
     * @param string $house
     *
     * @return RentalHouseRoomSearcher
     */
    public function setHouse($house) {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return string
     */
    public function getHouse() {
        return $this->house;
    }

    /**
     * Add type
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseType $type
     *
     * @return RentalHouseRoomSearcher
     */
    public function addType(\Daiquiri\AdminBundle\Entity\RentalHouseType $type) {
        $this->type[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseType $type
     */
    public function removeType(\Daiquiri\AdminBundle\Entity\RentalHouseType $type) {
        $this->type->removeElement($type);
    }

    /**
     * Get type
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Add facilitiesRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $facilitiesRoom
     *
     * @return RentalHouseRoomSearcher
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

    /**
     * Set privateRental
     *
     * @param boolean $privateRental
     *
     * @return RentalHouseRoomSearcher
     */
    public function setPrivateRental($privateRental) {
        $this->PrivateRental = $privateRental;

        return $this;
    }

    /**
     * Get privateRental
     *
     * @return boolean
     */
    public function getPrivateRental() {
        return $this->PrivateRental;
    }

    public function __toString() {

        $return = 'Search room ';
        
        if ($this->province){
            $return.=' In '.$this->province;                    
        }
        if ($this->polo){
            $return.=' In '.$this->polo;                    
        }
      
        if ($this->startdate) {
            $return.= ' Check in :' . $this->startdate->format('M j, Y');
        }
        if ($this->enddate) {
            $return.= ' Check out : ' . $this->startdate->format('M j, Y');
        }
        if ($this->adults) {
            $return.= ' For : ' . $this->adults . ' adult(s) ';
        }
        if ($this->kids) {
            $return.= ' and : ' . $this->kids . ' kid(s) ';
        }

        return $return;
    }
  
   

    

    /**
     * Set rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     *
     * @return RentalHouseRoomSearcher
     */
    public function setRentalhouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse = null)
    {
        $this->rentalhouse = $rentalhouse;

        return $this;
    }

    /**
     * Get rentalhouse
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouse
     */
    public function getRentalhouse()
    {
        return $this->rentalhouse;
    }

    /**
     * Set rentalhouseroom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom
     *
     * @return RentalHouseRoomSearcher
     */
    public function setRentalhouseroom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom = null)
    {
        $this->rentalhouseroom = $rentalhouseroom;

        return $this;
    }

    /**
     * Get rentalhouseroom
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouseRoom
     */
    public function getRentalhouseroom()
    {
        return $this->rentalhouseroom;
    }
}
