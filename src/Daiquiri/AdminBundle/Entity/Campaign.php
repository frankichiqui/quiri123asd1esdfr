<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Campaign
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"CampaignCircuit"="CampaignCircuit","Campaign"="Campaign","CampaignExcursion"="CampaignExcursionColective","CampaignPackage"="CampaignPackage","CampaignTransferExclusive"="CampaignTransferExclusive","CampaignTransferColective"="CampaignTransferColective","CampaignHotel"="CampaignHotel","CampaignCar"="CampaignCar","CampaignMedical"="CampaignMedical","CampaignExcursionExclusive"="CampaignExcursionExclusive","CampaignRentalHouse"="CampaignRentalHouse"})
 */
class Campaign {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @var \DateTime
     *
     * @ORM\Column(name="showstartdate", type="date")
     */
    private $showstartdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="showenddate", type="date")
     */
    private $showenddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="instartdate", type="date")
     */
    private $instartdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inenddate", type="date")
     */
    private $inenddate;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="caption", type="string", length=255)
     */
    private $caption;

    /**
     *  @ORM\ManyToMany(targetEntity="Market", inversedBy="campaigns")
     *  @ORM\JoinTable(name="market_campaigns")
     */
    private $markets;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="calification", type="integer", nullable=true, options={"default"=0})
     */
    private $calification;

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
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=20000, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="campaigns")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id", nullable=true)
     */
    private $block;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;

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
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    public function getproduct() {
        return;
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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Campaign
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
     * @return Campaign
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
     * Set showstartdate
     *
     * @param \DateTime $showstartdate
     *
     * @return Campaign
     */
    public function setShowstartdate($showstartdate) {
        $this->showstartdate = $showstartdate;

        return $this;
    }

    /**
     * Get showstartdate
     *
     * @return \DateTime
     */
    public function getShowstartdate() {
        return $this->showstartdate;
    }

    /**
     * Set showenddate
     *
     * @param \DateTime $showenddate
     *
     * @return Campaign
     */
    public function setShowenddate($showenddate) {
        $this->showenddate = $showenddate;

        return $this;
    }

    /**
     * Get showenddate
     *
     * @return \DateTime
     */
    public function getShowenddate() {
        return $this->showenddate;
    }

    /**
     * Set instartdate
     *
     * @param \DateTime $instartdate
     *
     * @return Campaign
     */
    public function setInstartdate($instartdate) {
        $this->instartdate = $instartdate;

        return $this;
    }

    /**
     * Get instartdate
     *
     * @return \DateTime
     */
    public function getInstartdate() {
        return $this->instartdate;
    }

    /**
     * Set inenddate
     *
     * @param \DateTime $inenddate
     *
     * @return Campaign
     */
    public function setInenddate($inenddate) {
        $this->inenddate = $inenddate;

        return $this;
    }

    /**
     * Get inenddate
     *
     * @return \DateTime
     */
    public function getInenddate() {
        return $this->inenddate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Campaign
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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Campaign
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * Set caption
     *
     * @param string $caption
     *
     * @return Campaign
     */
    public function setCaption($caption) {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Campaign
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Campaign
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
     * @return Campaign
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
     * Constructor
     */
    public function __construct() {
        $this->markets = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->markets->contains($element)
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Campaign
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
     * Set description
     *
     * @param string $description
     *
     * @return Campaign
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
     * Add market
     *
     * @param \Daiquiri\AdminBundle\Entity\Market $market
     *
     * @return Campaign
     */
    public function addMarket(\Daiquiri\AdminBundle\Entity\Market $market) {
        $this->markets[] = $market;

        return $this;
    }

    /**
     * Remove market
     *
     * @param \Daiquiri\AdminBundle\Entity\Market $market
     */
    public function removeMarket(\Daiquiri\AdminBundle\Entity\Market $market) {
        $this->markets->removeElement($market);
    }

    /**
     * Get markets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarkets() {
        return $this->markets;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Campaign
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
     * Set block
     *
     * @param \Daiquiri\AdminBundle\Entity\Block $block
     *
     * @return Campaign
     */
    public function setBlock(\Daiquiri\AdminBundle\Entity\Block $block = null) {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Daiquiri\AdminBundle\Entity\Block
     */
    public function getBlock() {
        return $this->block;
    }

    public function __toString() {
        if ($this->title) {
            return $this->getTitle() . ' (' . $this->showstartdate->format("M j Y") . ' to ' . $this->showenddate->format("M j Y") . ")";
        };
        return '';
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Campaign
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
     * @return Campaign
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

    public function hasMarket($title) {
        foreach ($this->markets as $value) {
            if ($value->getTitle() == strtoupper($title)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set calification
     *
     * @param integer $calification
     *
     * @return Campaign
     */
    public function setCalification($calification) {
        $this->calification = $calification;

        return $this;
    }

    public function getCalification() {
        return $this->calification;
    }

}
