<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouse
 *
 * @ORM\Table(name="rental_house", indexes={@ORM\Index(name="IDX_FC3EB772A0EBC007", columns={"zone"}) })
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseRepository")
 */
class RentalHouse {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="private_rental", type="boolean", nullable=true)
     */
    private $privateRental;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * 
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     * 
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom", mappedBy="rental_house", cascade={"all"})
     */
    private $rental_house_rooms;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Zone
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Zone", inversedBy="rental_houses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone", referencedColumnName="id")
     * })
     */
    private $zone;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseFacility", mappedBy="rental_house", cascade={"all"})
     */
    private $rental_house_facilities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseType", inversedBy="rental_houses")
     * @ORM\JoinTable(name="rental_house_rental_house_type")
     */
    private $rental_house_type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseOwner", inversedBy="rental_houses")
     * @ORM\JoinTable(name="rental_house_rental_house_owner")
     */
    private $rental_house_owners;

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
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean", nullable=true)
     */
    private $available;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payonline", type="boolean", nullable=true)
     */
    private $payonline;

    
    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\TermConditionProduct", inversedBy="houses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_condition_house", referencedColumnName="id")
     * })
     */
    private $term_condition_house;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CancelationProduct", inversedBy="houses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancelation_house", referencedColumnName="id")
     * })
     */
    private $cancelation_house;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Document", mappedBy="houses")
     */
    private $documents;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="remarks", type="string", length=2000, nullable=true)
     */
    private $remarks;

    /**
     * @ORM\ManyToOne(targetEntity="ProductIncrement", inversedBy="rentalhouses", cascade={"persist"})
     * @ORM\JoinColumn(name="product_increment", referencedColumnName="id")
     */
    private $product_increment;

    /**
     * @ORM\OneToMany(targetEntity="ReviewRentalHouse", mappedBy="rentalhouse")
     */
    private $reviews;

    /**
     * Constructor
     */
    public function __construct() {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rental_house_type = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rental_house_rooms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rental_house_facilities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rental_house_owners = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set room
     *
     * @param integer $room
     *
     * @return RentalHouse
     */
    public function setRoom($room) {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return integer
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return RentalHouse
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
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set private
     *
     * @param boolean $private
     *
     * @return RentalHouse
     */
    public function setPrivate($private) {
        $this->private = $private;

        return $this;
    }

    /**
     * Get private
     *
     * @return boolean
     */
    public function getPrivate() {
        return $this->private;
    }

    /**
     * Set privateRental
     *
     * @param boolean $privateRental
     *
     * @return RentalHouse
     */
    public function setPrivateRental($privateRental) {
        $this->privateRental = $privateRental;

        return $this;
    }

    /**
     * Get privateRental
     *
     * @return boolean
     */
    public function getPrivateRental() {
        return $this->privateRental;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RentalHouse
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
     * @return RentalHouse
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
     * Add rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     *
     * @return RentalHouse
     */
    public function addRentalHouseRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom) {
        $rentalHouseRoom->setRentalHouse($this);
        $this->rental_house_rooms[] = $rentalHouseRoom;

        return $this;
    }

    /**
     * Remove rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     */
    public function removeRentalHouseRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom) {
        $rentalHouseRoom->setRentalHouse();
        $this->rental_house_rooms->removeElement($rentalHouseRoom);
    }

    /**
     * Get rentalHouseRooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseRooms() {
        return $this->rental_house_rooms;
    }

    public function setRentalHouseRooms(\Doctrine\Common\Collections\Collection $RentalHouseRooms) {//     
        $new = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($RentalHouseRooms as $c) {
            $this->addRentalHouseRoom($c);
            $new->add($c);
            $c->setRentalHouse($this);
        }
        $this->rental_house_rooms = $new;        
        return $this;
    }

    /**
     * Set zone
     *
     * @param \Daiquiri\AdminBundle\Entity\Zone $zone
     *
     * @return RentalHouse
     */
    public function setZone(\Daiquiri\AdminBundle\Entity\Zone $zone = null) {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \Daiquiri\AdminBundle\Entity\Zone
     */
    public function getZone() {
        return $this->zone;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return RentalHouse
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
     * @return RentalHouse
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

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return RentalHouse
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
     * @return RentalHouse
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

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return RentalHouse
     */
    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * Add rentalHouseType
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseType $rentalHouseType
     *
     * @return RentalHouse
     */
    public function addRentalHouseType(\Daiquiri\AdminBundle\Entity\RentalHouseType $rentalHouseType) {
        $this->rental_house_type[] = $rentalHouseType;

        return $this;
    }

    /**
     * Remove rentalHouseType
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseType $rentalHouseType
     */
    public function removeRentalHouseType(\Daiquiri\AdminBundle\Entity\RentalHouseType $rentalHouseType) {
        $this->rental_house_type->removeElement($rentalHouseType);
    }

    /**
     * Get rentalHouseType
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseType() {
        return $this->rental_house_type;
    }

    /**
     * Add rentalHouseFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalHouseFacility
     *
     * @return RentalHouse
     */
    public function addRentalHouseFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalHouseFacility) {
        $rentalHouseFacility->setRentalHouse($this);
        $this->rental_house_facilities[] = $rentalHouseFacility;


        return $this;
    }

    /**
     * Remove rentalHouseFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalHouseFacility
     */
    public function removeRentalHouseFacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalHouseFacility) {
        $rentalHouseFacility->setRentalHouse(null);
        $this->rental_house_facilities->removeElement($rentalHouseFacility);
    }

    /**
     * Get rentalHouseFacilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseFacilities() {
        return $this->rental_house_facilities;
    }

    /**
     * set RentalHouseFacilities
     *
     * @param \Doctrine\Common\Collections\Collection $RentalHouseFacilities
     */
    public function setRentalHouseFacilities(\Doctrine\Common\Collections\Collection $RentalHouseFacilities = null) {
        if (count($RentalHouseFacilities) > 0) {
            foreach ($RentalHouseFacilities as $facility) {
                $this->addRentalHouseFacility($facility);
            }
        }
        return $this;
    }

    /**
     * Add rentalHouseOwner
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseOwner $rentalHouseOwner
     *
     * @return RentalHouse
     */
    public function addRentalHouseOwner(\Daiquiri\AdminBundle\Entity\RentalHouseOwner $rentalHouseOwner) {
        $this->rental_house_owners[] = $rentalHouseOwner;
        return $this;
    }

    /**
     * Remove rentalHouseOwner
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseOwner $rentalHouseOwner
     */
    public function removeRentalHouseOwner(\Daiquiri\AdminBundle\Entity\RentalHouseOwner $rentalHouseOwner) {
        $this->rental_house_owners->removeElement($rentalHouseOwner);
    }

    /**
     * Get rentalHouseOwners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseOwners() {
        return $this->rental_house_owners;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return RentalHouse
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return RentalHouse
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude() {
        return $this->longitude;
    }

    public function getRoomAvailablesInRangeDate(\DateTime $startdate, \DateTime $enddate) {

        $a = array();
        foreach ($this->rental_house_rooms as $r) {
            if ($r->isAvailableInDateRange($startdate, $enddate) && $r->getAvailable()) {
                $a[] = $r;
            }
        }

        if (count($a) > 0) {

            return $a;
        }
        return null;
    }

    public function getRooms() {
        return $this->rental_house_rooms->count();
    }

    public function hasFacilityType(RentalHouseFacilityType $facility = null) {
        if (!$facility || $this->rental_house_facilities->isEmpty()) {
            return false;
        }
        foreach ($this->rental_house_facilities as $fa) {
            $type = $fa->getRentalhousefacilitytype();
            if ($type) {
                if ($type->getId() == $facility->getId()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function hasFacilitiesType($facilities = null) {
        if (!$facilities || count($facilities) == 0) {
            return true;
        }
        foreach ($facilities as $fa) {
            if (!$this->hasFacilityType($fa)) {
                return false;
            }
        }
        return true;
    }

    public function hasTypes($types) {

        if (count($types) == 0 || count($this->rental_house_type) == 0) {
            return true;
        }
        foreach ($types as $t) {
            if (!$this->rental_house_type->contains($t)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return RentalHouse
     */
    public function setAvailable($available) {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        return $this->available;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return RentalHouse
     */
    public function setPriority($priority) {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * Set payonline
     *
     * @param boolean $payonline
     *
     * @return RentalHouse
     */
    public function setPayonline($payonline) {
        $this->payonline = $payonline;

        return $this;
    }

    /**
     * Get payonline
     *
     * @return boolean
     */
    public function getPayonline() {
        return $this->payonline;
    }

    

    

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return RentalHouse
     */
    public function setRemarks($remarks) {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks() {
        return $this->remarks;
    }

    /**
     * Set termConditionHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse
     *
     * @return RentalHouse
     */
    public function setTermConditionHouse(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse = null) {
        $this->term_condition_house = $termConditionHouse;

        return $this;
    }

    /**
     * Get termConditionHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionHouse() {
        return $this->term_condition_house;
    }

    /**
     * Set cancelationHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse
     *
     * @return RentalHouse
     */
    public function setCancelationHouse(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse = null) {
        $this->cancelation_house = $cancelationHouse;

        return $this;
    }

    /**
     * Get cancelationHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationHouse() {
        return $this->cancelation_house;
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return RentalHouse
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments() {
        return $this->documents;
    }

    public function getType() {
        return 'RentalHouse';
    }

    /**
     * Set productIncrement
     *
     * @param \Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement
     *
     * @return RentalHouse
     */
    public function setProductIncrement(\Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement = null) {
        $this->product_increment = $productIncrement;

        return $this;
    }

    /**
     * Get productIncrement
     *
     * @return \Daiquiri\AdminBundle\Entity\ProductIncrement
     */
    public function getProductIncrement() {
        return $this->product_increment;
    }

    public function getMaxOcupation() {
        $rooms = $this->getRentalHouseRooms();
        $ocupation = array();
        if (count($rooms) > 0) {
            $aux = array();
            foreach ($rooms as $room) {
                $aux = $room->getRentalHouseRoomOcupations();
                if (count($aux) > 0) {
                    $ocupation = array('adults' => $aux[0]->getAdult(), 'kids' => $aux[0]->getKid());
                    foreach ($aux as $a) {
                        if ($ocupation['adults'] < $a->getAdult()) {
                            $ocupation['adults'] = $a->getAdult();
                        }
                        if ($ocupation['kids'] < $a->getKid()) {
                            $ocupation['kids'] = $a->getKid();
                        }
                    }
                }
            }
        }

        return $ocupation;
    }

    public function getTotalBathRooms() {
        $rooms = $this->getRentalHouseRooms();
        $bathrooms = 0;
        if (count($rooms) > 0) {
            $facilities = array();
            foreach ($rooms as $room) {
                $facilities = $room->getRentalHouseRoomFacilities();
                if (count($facilities) > 0) {
                    foreach ($facilities as $facility) {
                        if ($facility->getFaicon() == 'im im-shower') {
                            $bathrooms++;
                        }
                    }
                }
            }
        }
        return $bathrooms;
    }

    public function getFromprice() {
        $min = 70000000;
        foreach ($this->rental_house_rooms as $r) {
            if ($min > $r->getFromprice()) {
                $min = $r->getFromprice();
            }
        }
        return $min;
    }

}
