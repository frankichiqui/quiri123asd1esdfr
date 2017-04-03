<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Season
 *
 * @ORM\Table(name="season", indexes={@ORM\Index(name="IDX_F0E45BA9631066A6", columns={"hotelid"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\SeasonRepository")
 */
class Season {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="season_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date", nullable=true)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date", nullable=true)
     */
    private $enddate;

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
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

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
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", inversedBy="seasons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotelid", referencedColumnName="id")
     * })
     */
    private $hotel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\HotelPrice", mappedBy="season", cascade={"all"})
     */
    private $season_hotel_price;

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
     * @return Season
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
     * @return Season
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
     * Set description
     *
     * @param string $description
     *
     * @return Season
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
     * Set title
     *
     * @param string $title
     *
     * @return Season
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
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Season
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
     * @return Season
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
     * @return Season
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
        return strtoupper($this->hotel . "") . " - " . $this->getTitle() . " " . $this->startdate->format('M j, Y') . ' - ' . $this->enddate->format('M j, Y');
    }

    public function nameAndDates() {
        return strtoupper($this->getTitle()) . " " . $this->startdate->format('M j, Y') . ' - ' . $this->enddate->format('M j, Y');
    }

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->room_season_ocupation_prices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->season_data_hotel_price = new \Doctrine\Common\Collections\ArrayCollection();
        $this->season_hotel_price = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function containDate(\DateTime $date) {
        if ($this->startdate <= $date && $date <= $this->enddate) {
            return true;
        }
        return false;
    }

    /**
     * Add seasonHotelPrice
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelPrice $seasonHotelPrice
     *
     * @return Season
     */
    public function addSeasonHotelPrice(\Daiquiri\AdminBundle\Entity\HotelPrice $seasonHotelPrice) {
        $this->season_hotel_price[] = $seasonHotelPrice;

        return $this;
    }

    /**
     * Remove seasonHotelPrice
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelPrice $seasonHotelPrice
     */
    public function removeSeasonHotelPrice(\Daiquiri\AdminBundle\Entity\HotelPrice $seasonHotelPrice) {
        $this->season_hotel_price->removeElement($seasonHotelPrice);
    }

    /**
     * Get seasonHotelPrice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasonHotelPrice() {
        return $this->season_hotel_price;
    }

}
