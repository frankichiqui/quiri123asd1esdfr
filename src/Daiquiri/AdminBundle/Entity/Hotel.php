<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\HotelRepository")
 */
class Hotel extends Place {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="stars", type="integer", nullable=true)
     */
    private $stars;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="checkin", type="string", length=255, nullable=true)
     */
    private $checkin;
    /**
     * @var string
     *
     * @ORM\Column(name="checkout", type="string", length=255, nullable=true)
     */
    private $checkout;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var float
     *
     * @ORM\Column(name="mount_c", type="float", nullable=true)
     */
    private $mountC;

    /**
     * @var float
     *
     * @ORM\Column(name="mount_Cc", type="float", nullable=true)
     */
    private $mountCc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ai", type="boolean", nullable=true)
     */
    private $ai;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_infant", type="boolean", nullable=true)
     */
    private $allowInfant;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Season", mappedBy="hotel",  cascade={"all"}, orphanRemoval=true)
     */
    private $seasons;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\HotelFacility", mappedBy="hotel", cascade={"all"}, orphanRemoval=true)
     */
    private $hotel_facilitys;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\HotelSalesAgent", mappedBy="hotel", cascade={"all"}, orphanRemoval=true)
     */
    private $hotel_sales_agents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Room", mappedBy="hotel", cascade={"all"}, orphanRemoval=true)
     */
    private $rooms;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Suplement", mappedBy="hotel", cascade={"all"}, orphanRemoval=true)
     */
    private $suplements;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Zone", inversedBy="hotels")
     * @ORM\JoinColumn(name="zone", referencedColumnName="id")
     * 
     *   
     */
    private $zone;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Chain
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Chain", inversedBy="hotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chainid", referencedColumnName="id")
     * })
     */
    private $chain;

    /**
     * @var \Daiquiri\AdminBundle\Entity\HotelType
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\HotelType", inversedBy="hotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotelType", referencedColumnName="id")
     * })
     */
    private $hotelType;

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
     * @var boolean
     *
     * @ORM\Column(name="review_available", type="boolean", nullable=true)
     */
    private $reviewAvailable;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\TermConditionProduct", inversedBy="hotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_condition_hotel", referencedColumnName="id")
     * })
     */
    private $term_condition_hotel;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CancelationProduct", inversedBy="hotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancelation_hotel", referencedColumnName="id")
     * })
     */
    private $cancelation_hotel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Document", mappedBy="hotels")
     */
    private $documents;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="remarks", type="string", length=2000, nullable=true)
     */
    private $remarks;

    /**
     * @ORM\ManyToOne(targetEntity="ProductIncrement", inversedBy="hotels", cascade={"persist"})
     * @ORM\JoinColumn(name="product_increment", referencedColumnName="id")
     */
    private $product_increment;

    /**
     * @ORM\OneToMany(targetEntity="ReviewHotel", mappedBy="hotel")
     */
    private $reviews;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * Constructor
     */
    public function __construct() {
        $this->payonline = true;
        $this->seasons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotel_facilitys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotel_sales_agents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->suplements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        parent::setIspickupplaceExcursion(true);
        parent::setIspickupplaceCircuit(true);
        parent::setIspickupplaceTransfer(true);
    }

    public function hasSeason(Season $season) {
        foreach ($this->seasons as $s) {
            //igual 
            if ($season->getStartdate() == $s->getStartdate() && $season->getEnddate() == $s->getEnddate()) {
                return true;
            }
            if ($season->getStartdate() < $s->getStartdate() && $season->getEnddate() < $s->getEnddate()) {
                return true;
            }
            return false;
        }
    }

    /**
     * Set stars
     *
     * @param integer $stars
     *
     * @return Hotel
     */
    public function setStars($stars) {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars
     *
     * @return integer
     */
    public function getStars() {
        return $this->stars;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Hotel
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Hotel
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Hotel
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set mountC
     *
     * @param float $mountC
     *
     * @return Hotel
     */
    public function setMountC($mountC) {
        $this->mountC = $mountC;

        return $this;
    }

    /**
     * Get mountC
     *
     * @return float
     */
    public function getMountC() {
        return $this->mountC;
    }

    /**
     * Set mountCc
     *
     * @param string $mountCc
     *
     * @return Hotel
     */
    public function setMountCc($mountCc) {
        $this->mountCc = $mountCc;

        return $this;
    }

    /**
     * Get mountCc
     *
     * @return string
     */
    public function getMountCc() {
        return $this->mountCc;
    }

    /**
     * Set seasons
     *
     * @param \Doctrine\Common\Collections\Collection $seasons
     */
    public function setSeasons(\Doctrine\Common\Collections\Collection $seasons = null) {
        if (count($seasons) > 0) {
            foreach ($seasons as $season) {
                $this->addSeason($season);
            }
        }

        return $this;
    }

    /**
     * Add season
     *
     * @param \Daiquiri\AdminBundle\Entity\Season $season
     *
     * @return Hotel
     */
    public function addSeason(\Daiquiri\AdminBundle\Entity\Season $season) {
        $season->setHotel($this);
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \Daiquiri\AdminBundle\Entity\Season $season
     */
    public function removeSeason(\Daiquiri\AdminBundle\Entity\Season $season) {
        $season->setHotel(null);
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons() {
        return $this->seasons;
    }

    /**
     * Set hotelFacilites
     *
     * @param \Doctrine\Common\Collections\Collection $hotelFacilites
     */
    public function setHotelFacilities(\Doctrine\Common\Collections\Collection $hotelFacilites = null) {
        if (count($hotelFacilites) > 0) {
            foreach ($hotelFacilites as $hotelfacility) {
                $this->addHotelFacility($hotelfacility);
            }
        }

        return $this;
    }

    /**
     * Add hotelFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelFacility $hotelFacility
     *
     * @return Hotel
     */
    public function addHotelFacility(\Daiquiri\AdminBundle\Entity\HotelFacility $hotelFacility) {
        $hotelFacility->setHotel($this);
        $this->hotel_facilitys[] = $hotelFacility;

        return $this;
    }

    /**
     * Remove hotelFacility
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelFacility $hotelFacility
     */
    public function removeHotelFacility(\Daiquiri\AdminBundle\Entity\HotelFacility $hotelFacility) {
        $hotelFacility->setHotel(null);
        $this->hotel_facilitys->removeElement($hotelFacility);
    }

    /**
     * Get hotelFacilitys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelFacilitys() {
        return $this->hotel_facilitys;
    }

    /**
     * Set hotelSalesAgents
     *
     * @param \Doctrine\Common\Collections\Collection $hotelSalesAgents
     */
    public function setHotelSalesAgents(\Doctrine\Common\Collections\Collection $hotelSalesAgents = null) {
        if (count($hotelSalesAgents) > 0) {
            foreach ($hotelSalesAgents as $hotelSalesAgent) {
                $this->addHotelSalesAgent($hotelSalesAgent);
            }
        }

        return $this;
    }

    /**
     * Add hotelSalesAgent
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelSalesAgent $hotelSalesAgent
     *
     * @return Hotel
     */
    public function addHotelSalesAgent(\Daiquiri\AdminBundle\Entity\HotelSalesAgent $hotelSalesAgent) {
        $hotelSalesAgent->setHotel($this);
        $this->hotel_sales_agents[] = $hotelSalesAgent;

        return $this;
    }

    /**
     * Remove hotelSalesAgent
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelSalesAgent $hotelSalesAgent
     */
    public function removeHotelSalesAgent(\Daiquiri\AdminBundle\Entity\HotelSalesAgent $hotelSalesAgent) {
        $hotelSalesAgent->setHotel(null);
        $this->hotel_sales_agents->removeElement($hotelSalesAgent);
    }

    /**
     * Get hotelSalesAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelSalesAgents() {
        return $this->hotel_sales_agents;
    }

    /**
     * Set rooms
     *
     * @param \Doctrine\Common\Collections\Collection $rooms
     */
    public function setRooms(\Doctrine\Common\Collections\Collection $rooms = null) {
        if (count($rooms) > 0) {
            foreach ($rooms as $room) {
                $this->addRoom($room);
            }
        }

        return $this;
    }

    /**
     * Add room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return Hotel
     */
    public function addRoom(\Daiquiri\AdminBundle\Entity\Room $room) {
        $room->setHotel($this);
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     */
    public function removeRoom(\Daiquiri\AdminBundle\Entity\Room $room) {
        $room->setHotel(null);
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms() {
        return $this->rooms;
    }

    /**
     * Set suplements
     *
     * @param \Doctrine\Common\Collections\Collection $suplements
     */
    public function setSuplements(\Doctrine\Common\Collections\Collection $suplements = null) {
        if (count($suplements) > 0) {
            foreach ($suplements as $suplement) {
                $this->addSuplement($suplement);
            }
        }

        return $this;
    }

    /**
     * Add suplement
     *
     * @param \Daiquiri\AdminBundle\Entity\Suplement $suplement
     *
     * @return Hotel
     */
    public function addSuplement(\Daiquiri\AdminBundle\Entity\Suplement $suplement) {
        $suplement->setHotel($this);
        $this->suplements[] = $suplement;

        return $this;
    }

    /**
     * Remove suplement
     *
     * @param \Daiquiri\AdminBundle\Entity\Suplement $suplement
     */
    public function removeSuplement(\Daiquiri\AdminBundle\Entity\Suplement $suplement) {
        $suplement->setHotel(null);
        $this->suplements->removeElement($suplement);
    }

    /**
     * Get suplements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuplements() {
        return $this->suplements;
    }

    /**
     * Set zone
     *
     * @param \Daiquiri\AdminBundle\Entity\Zone $zone
     *
     * @return Hotel
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
     * Set chain
     *
     * @param \Daiquiri\AdminBundle\Entity\Chain $chain
     *
     * @return Hotel
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
     * Set hotelType
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelType $hotelType
     *
     * @return Hotel
     */
    public function setHotelType(\Daiquiri\AdminBundle\Entity\HotelType $hotelType = null) {
        $this->hotelType = $hotelType;

        return $this;
    }

    /**
     * Get hotelType
     *
     * @return \Daiquiri\AdminBundle\Entity\HotelType
     */
    public function getHotelType() {
        return $this->hotelType;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Hotel
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Hotel
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
     * @return Hotel
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
     * @return Hotel
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
     * Set reviewAvailable
     *
     * @param boolean $reviewAvailable
     *
     * @return Hotel
     */
    public function setReviewAvailable($reviewAvailable) {
        $this->reviewAvailable = $reviewAvailable;

        return $this;
    }

    /**
     * Get reviewAvailable
     *
     * @return boolean
     */
    public function getReviewAvailable() {
        return $this->reviewAvailable;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Hotel
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
     * Set pictureSlide
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $pictureSlide
     *
     * @return Hotel
     */
    public function setPictureSlide(\Application\Sonata\MediaBundle\Entity\Media $pictureSlide = null) {
        $this->pictureSlide = $pictureSlide;

        return $this;
    }

    /**
     * Get pictureSlide
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPictureSlide() {
        return $this->pictureSlide;
    }

    /**
     * Set termConditionProduct
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionProduct
     *
     * @return Hotel
     */
    public function setTermConditionProduct(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionProduct = null) {
        $this->term_condition_product = $termConditionProduct;

        return $this;
    }

    /**
     * Get termConditionProduct
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionProduct() {
        return $this->term_condition_product;
    }

    /**
     * Set cancelationProduct
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationProduct
     *
     * @return Hotel
     */
    public function setCancelationProduct(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationProduct = null) {
        $this->cancelation_product = $cancelationProduct;

        return $this;
    }

    /**
     * Get cancelationProduct
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationProduct() {
        return $this->cancelation_product;
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return Hotel
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $document->addHotel($this);
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $document->removeHotel($this);
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

    /**
     * Set termConditionHotel
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHotel
     *
     * @return Hotel
     */
    public function setTermConditionHotel(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHotel = null) {
        $this->term_condition_hotel = $termConditionHotel;

        return $this;
    }

    /**
     * Get termConditionHotel
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionHotel() {
        return $this->term_condition_hotel;
    }

    /**
     * Set cancelationHotel
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHotel
     *
     * @return Hotel
     */
    public function setCancelationHotel(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHotel = null) {
        $this->cancelation_hotel = $cancelationHotel;

        return $this;
    }

    /**
     * Get cancelationHotel
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationHotel() {
        return $this->cancelation_hotel;
    }

    /**
     * Set ai
     *
     * @param boolean $ai
     *
     * @return Hotel
     */
    public function setAi($ai) {
        $this->ai = $ai;

        return $this;
    }

    /**
     * Get ai
     *
     * @return boolean
     */
    public function getAi() {
        return $this->ai;
    }

    /**
     * Set allowInfant
     *
     * @param boolean $allowInfant
     *
     * @return Hotel
     */
    public function setAllowInfant($allowInfant) {
        $this->allowInfant = $allowInfant;

        return $this;
    }

    /**
     * Get allowInfant
     *
     * @return boolean
     */
    public function getAllowInfant() {
        return $this->allowInfant;
    }

    public function hasFacilityType(RentalHouseFacilityType $facility = null) {
        if (!$facility || $this->hotel_facilitys->isEmpty()) {
            return false;
        }
        foreach ($this->hotel_facilitys as $fa) {
            if ($fa->getHotelfacilitytype()) {
                if ($fa->getHotelfacilitytype()->getId() === $facility->getId()) {
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

    public function getAllRoomAvailableInDates(\DateTime $startdate, \DateTime $enddate) {
        $rooms = array();
        if (Validate::startAndEndDate($startdate, $enddate)) {
            if ($this->rooms) {
                foreach ($this->rooms as $r) {
                    if ($r->isAvailableInDateRange($startdate, $enddate)) {
                        $rooms[] = $r;
                    }
                }
            }
        }
        return $rooms;
    }

    public function getSeasonByDate(\DateTime $date) {
        if (count($this->seasons) > 0) {
            foreach ($this->seasons as $s) {
                if ($s->containDate($date)) {
                    return $s;
                }
            }
        }

        return null;
    }

    public function getArrayAvailablePlan() {
        if (!$this->ai) {
            $salida = array(array('nomenclator' => 'B&B', 'text' => 'Bed and Breakfast', 'value' => 0));
            if ($this->mountC != 0) {
                $salida[] = array('nomenclator' => 'MP', 'text' => 'Half pension', 'value' => $this->mountC);
            }
            if ($this->mountCc != 0) {
                $salida[] = array('nomenclator' => 'FP', 'text' => 'Full Pension', 'value' => $this->mountCc);
            }
        } else {
            $salida = array(array('nomenclator' => 'AI', 'text' => 'All inclusive', 'value' => 0));
        }
        return $salida;
    }

    public function availableDiteforList() {
        $salida = 'B&B ';
        if ($this->ai) {
            return 'AI';
        } else if ($this->mountC == 0 && $this->mountCc == 0) {
            return 'B&B';
        } else {

            if ($this->mountC != 0) {
                $salida.='HP ';
            }
            if ($this->mountCc != 0) {
                $salida.='FP ';
            }
        }
        return $salida;
    }

    public function getSimpleArrayAvailablePlan() {
        if (!$this->ai) {
            $salida = array('B&B' => 'B&B');
            if ($this->mountC != 0) {
                $salida['HP'] = 'HP';
            }

            if ($this->mountCc != 0) {
                $salida['FP'] = 'FP';
            }
        } else {
            return array('AI' => 'AI');
        }

        return $salida;
    }

    public function getSuplementByDate(\DateTime $date) {
        if (count($this->suplements) > 0) {
            foreach ($this->suplements as $s) {
                if ($s->getDate()->format('M j, Y') == $date->format('M j, Y')) {
                    return $s;
                }
            }
        }
        return null;
    }

    public function getAllSuplementByDateRange(\DateTime $startdate, \DateTime $enddate) {
        $suplement = array();
        if (count($this->suplements) > 0) {
            if (Validate::startAndEndDate($startdate, $enddate)) {
                $interval = new \DateInterval('P1D');
                $final = $enddate;
                $daterange = new \DatePeriod($startdate, $interval, $final);
                foreach ($daterange as $date) {
                    $s = $this->getSuplementByDate($date);
                    if ($s) {
                        $suplement[] = $s;
                    }
                }
            }
        }
        return $suplement;
    }

    public function auxgetPlusForDiet($diet) {

        if ($diet == 'AI') {
            return 0;
        }
        if ($diet == 'B&B') {
            return 0;
        }
        if ($diet == 'HP') {
            if ($this->mountC != 0) {
                return $this->mountC;
            } else {
                return -1;
            }
        }
        if ($diet == 'FP') {
            if ($this->mountCc != 0) {
                return $this->mountCc;
            } else {
                return -1;
            }
        }
    }

    public function getPlusForDiet(\Daiquiri\ReservationBundle\Entity\OcupationItem $item) {
        return $this->auxgetPlusForDiet($item->getPlan()) *
                ($item->getAdults() + $item->getKids()) *
                ($item->getDiffDays());
    }

    public function getFullLocation() {
        return $this . ', ' . $this->address . ', ' . $this->zone . ', ';
    }

    public function fullTitle() {
        return 'Hotel ' . $this->getTitle();
    }

    public function getCurrentSeasons() {
        $arr = array();
        foreach ($this->seasons as $s) {
            if ($s->getEnddate() > (new \DateTime('today'))) {
                $arr[] = $s;
            }
        }
        return $arr;
    }

    /**
     * Set productIncrement
     *
     * @param \Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement
     *
     * @return Hotel
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

    public function getFromprice() {
        $min = 70000000;
        foreach ($this->rooms as $r) {
            if ($min > $r->getFromprice()) {
                $min = $r->getFromprice();
            }
        }
        return $min;
    }

    public function getFacilityTypes() {
        $types = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->hotel_facilitys as $value) {
            if ($value->getHotelfacilitytype()) {
                if (!$types->contains($value->getHotelfacilitytype())) {
                    $types->add($value->getHotelfacilitytype());
                }
            }
        }
        return $types;
    }

    /**
     * Add review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     *
     * @return Hotel
     */
    public function addReview(\Daiquiri\AdminBundle\Entity\ReviewHotel $review) {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Daiquiri\AdminBundle\Entity\ReviewHotel $review
     */
    public function removeReview(\Daiquiri\AdminBundle\Entity\ReviewHotel $review) {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews() {
        return $this->reviews;
    }

    public function getReviewEvaluation() {
        $cant = 0;
        foreach ($this->reviews as $r) {
            if ($r->getVotes() == 5 || $r->getVotes() == 4) {
                $cant++;
            }
        }
        if ($this->reviews->count() > 0) {
            return ($cant / $this->reviews->count()) * 100;
        }
        return 0;
    }

    public function getAverageVotes() {
        $cant = 0;
        foreach ($this->reviews as $r) {
            $cant+=$r->getVotes();
        }
        if ($this->reviews->count() > 0) {
            return ($cant / $this->reviews->count());
        }
        return 0;
    }

    public function printStart() {
        $ave = $this->getAverageVotes();
        $num = explode('.', $ave);
        $salida = '';
        for ($i = 0; $i < $num[0]; $i++) {
            $salida.= '<li><i class="fa fa-star"></i></li>';
        }
        if (isset($num[1])) {
            $salida.= '<li><i class="fa fa-star-half-empty"></i></li>';
        }
        return $salida;
    }


    /**
     * Set checkin
     *
     * @param string $checkin
     *
     * @return Hotel
     */
    public function setCheckin($checkin)
    {
        $this->checkin = $checkin;

        return $this;
    }

    /**
     * Get checkin
     *
     * @return string
     */
    public function getCheckin()
    {
        return $this->checkin;
    }

    /**
     * Set checkout
     *
     * @param string $checkout
     *
     * @return Hotel
     */
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;

        return $this;
    }

    /**
     * Get checkout
     *
     * @return string
     */
    public function getCheckout()
    {
        return $this->checkout;
    }
}
