<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Room
 *
 * @ORM\Table(name="room", indexes={@ORM\Index(name="IDX_729F519B631066A6", columns={"hotelid"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RoomRepository")
 * 
 */
class Room {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="room_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"id", "title"})
     */
    private $uniqueSlug;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
    private $picture;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", cascade={"all"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="gallery", referencedColumnName="id")
     * })
     */
    private $gallery;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility", inversedBy="rooms")
     * @ORM\JoinTable(name="room_facilities_rooms")
     */
    private $room_facilities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RoomAvailability", mappedBy="room", cascade={"all"}, orphanRemoval=true)
     */
    private $room_availabilitys;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Ocupation", mappedBy="room", cascade={"persist","refresh"}, orphanRemoval=true)
     */
    private $ocupations;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", inversedBy="rooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotelid", referencedColumnName="id")
     * })
     */
    private $hotel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\HotelPrice", mappedBy="room", cascade={"all"})
     */
    private $room_hotel_price;

    /**
     * @ORM\OneToMany(targetEntity="CampaignHotel", mappedBy="room")
     */
    private $campaigns;

    /**
     * @var string
     *
     * @ORM\Column(name="numberofbeds", type="integer",options={"default"=1})
     */
    private $numberofbeds;
    /**
     * @var float
     *
     * @ORM\Column(name="area", type="float",options={"default"=20})
     */
    private $area;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Room
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
     * Set description
     *
     * @param string $description
     *
     * @return Room
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set roomAvailabilitys
     *
     * @param \Doctrine\Common\Collections\Collection $roomAvailabilitys
     */
    public function setRoomAvailabilities(\Doctrine\Common\Collections\Collection $roomAvailabilitys = null) {
        if (count($roomAvailabilitys) > 0) {
            foreach ($roomAvailabilitys as $roomAvailability) {
                $this->addRoomAvailability($roomAvailability);
            }
        }

        return $this;
    }

    /**
     * Add roomAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\RoomAvailability $roomAvailability
     *
     * @return Room
     */
    public function addRoomAvailability(\Daiquiri\AdminBundle\Entity\RoomAvailability $roomAvailability) {
        $roomAvailability->setRoom($this);
        $this->room_availabilitys[] = $roomAvailability;

        return $this;
    }

    /**
     * Remove roomAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\RoomAvailability $roomAvailability
     */
    public function removeRoomAvailability(\Daiquiri\AdminBundle\Entity\RoomAvailability $roomAvailability) {
        $roomAvailability->setRoom(null);
        $this->room_availabilitys->removeElement($roomAvailability);
    }

    /**
     * Get roomAvailabilitys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomAvailabilitys() {
        return $this->room_availabilitys;
    }

    /**
     * Set ocupation
     *
     * @param \Doctrine\Common\Collections\Collection $ocupations
     */
    public function setOcupations(\Doctrine\Common\Collections\Collection $ocupations = null) {
        if (count($ocupations) > 0) {
            foreach ($ocupations as $ocupation) {
                $this->addOcupation($ocupation);
            }
        }

        return $this;
    }

    /**
     * Add ocupation
     *
     * @param \Daiquiri\AdminBundle\Entity\Ocupation $ocupation
     *
     * @return Room
     */
    public function addOcupation(\Daiquiri\AdminBundle\Entity\Ocupation $ocupation) {
        $ocupation->setRoom($this);
        $this->ocupations[] = $ocupation;

        return $this;
    }

    /**
     * Remove ocupation
     *
     * @param \Daiquiri\AdminBundle\Entity\Ocupation $ocupation
     */
    public function removeOcupation(\Daiquiri\AdminBundle\Entity\Ocupation $ocupation) {
        $ocupation->setRoom(null);
        $this->ocupations->removeElement($ocupation);
    }

    /**
     * Get ocupations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOcupations() {
        return $this->ocupations;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->room_availabilitys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ocupations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->room_data_hotel_price = new \Doctrine\Common\Collections\ArrayCollection();
        $this->room_hotel_price = new \Doctrine\Common\Collections\ArrayCollection();
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Room
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Room
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return Room
     */
    public function setUniqueSlug($uniqueSlug) {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug() {
        return $this->uniqueSlug;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Room
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Room
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null) {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery() {
        return $this->gallery;
    }

    /**
     * Add roomFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $roomFacility
     *
     * @return Room
     */
    public function addRoomFacility(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $roomFacility) {
        $this->room_facilities[] = $roomFacility;

        return $this;
    }

    /**
     * Remove roomFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $roomFacility
     */
    public function removeRoomFacility(\Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility $roomFacility) {
        $this->room_facilities->removeElement($roomFacility);
    }

    /**
     * Get roomFacilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomFacilities() {
        return $this->room_facilities;
    }

    public function isAvailableInDate(\DateTime $date) {
        if (count($this->room_availabilitys) > 0) {
            foreach ($this->room_availabilitys as $av) {
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

    public function hasOcupation($adult, $kid) {
        foreach ($this->ocupations as $o) {

            if ($o->getAdults() == $adult && $o->getKids() == $kid && $o->getAvailable()) {

                return true;
            }
        }
        return false;
    }

    public function getOcupation($adult, $kid) {
        foreach ($this->ocupations as $o) {

            if ($o->getAdults() == $adult && $o->getKids() == $kid && $o->getAvailable()) {
                return $o;
            }
        }
        return null;
    }

    public function hasFacility(RentalHouseRoomFacility $f) {
        return $this->room_facilities->contains($f);
    }

    public function hasFacilitys($facilities = null) {

        if (!$facilities || $facilities->isEmpty()) {
            return true;
        }
        if ($this->room_facilities->isEmpty()) {
            return false;
        }
        foreach ($facilities as $f) {
            if (!$this->hasFacility($f)) {
                return false;
            }
        }
        return true;
    }

    public function titleHotelRoom() {
        return $this->hotel . " - " . strtoupper($this->title);
    }

    /**
     * Add roomHotelPrice
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelPrice $roomHotelPrice
     *
     * @return Room
     */
    public function addRoomHotelPrice(\Daiquiri\AdminBundle\Entity\HotelPrice $roomHotelPrice) {
        $this->room_hotel_price[] = $roomHotelPrice;

        return $this;
    }

    /**
     * Remove roomHotelPrice
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelPrice $roomHotelPrice
     */
    public function removeRoomHotelPrice(\Daiquiri\AdminBundle\Entity\HotelPrice $roomHotelPrice) {
        $this->room_hotel_price->removeElement($roomHotelPrice);
    }

    /**
     * Get roomHotelPrice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomHotelPrice() {
        return $this->room_hotel_price;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignHotel $campaign
     *
     * @return Room
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignHotel $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignHotel $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignHotel $campaign) {
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
        $min = 70000000;
        foreach ($this->room_hotel_price as $r) {
            if ($min > $r->getAdult1()) {
                $min = $r->getAdult1();
            }
        }
        return $min;
    }

    public function maxAdultOcup() {
        $max = 0;
        foreach ($this->ocupations as $o) {
            if ($o->getAdults() > $max) {
                $max = $o->getAdults();
            }
        }
        return $max;
    }


    /**
     * Set numberofbeds
     *
     * @param integer $numberofbeds
     *
     * @return Room
     */
    public function setNumberofbeds($numberofbeds)
    {
        $this->numberofbeds = $numberofbeds;

        return $this;
    }

    /**
     * Get numberofbeds
     *
     * @return integer
     */
    public function getNumberofbeds()
    {
        return $this->numberofbeds;
    }

    /**
     * Set area
     *
     * @param float $area
     *
     * @return Room
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return float
     */
    public function getArea()
    {
        return $this->area;
    }
}
