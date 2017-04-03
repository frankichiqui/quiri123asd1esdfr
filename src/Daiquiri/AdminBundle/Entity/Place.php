<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Place
 *
 * @ORM\Table(name="place")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\PlaceRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"place"="Place","hotel"="Hotel", "airport"="Airport"})
 */
class Place {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="place_id_seq", allocationSize=1, initialValue=1)
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\PlaceType", inversedBy="places", cascade={"persist","refresh"})
     * @ORM\JoinTable(name="place_type_place")
     */
    private $placetypes;

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
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ispickupplace_excursion", type="boolean", nullable=true)
     */
    private $ispickupplace_excursion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ispickupplace_transfer", type="boolean", nullable=true)
     */
    private $ispickupplace_transfer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ispickupplace_circuit", type="boolean", nullable=true)
     */
    private $ispickupplace_circuit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ispickupplace_car", type="boolean", nullable=true)
     */
    private $ispickupplace_car;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Transfer", mappedBy="placefrom")
     */
    private $transfers_from;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Transfer", mappedBy="placeto")
     */
    private $transfers_to;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Excursion", mappedBy="places")
     */
    private $excursions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\CircuitDay", mappedBy="places")
     */
    private $circuit_days;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Polo
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo", inversedBy="places")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="polo", referencedColumnName="id")
     * })
     */
    private $polo;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Province
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Province", inversedBy="places")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="province", referencedColumnName="id")
     * })
     */
    private $province;

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

    /**
     * Constructor
     */
    public function __construct() {
        $this->transfers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->excursions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->circuit_days = new \Doctrine\Common\Collections\ArrayCollection();
        $this->placetypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Place
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Place
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
     * @return Place
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
     * Set typeplace
     *
     * @param string $typeplace
     *
     * @return Place
     */
    public function setTypeplace($typeplace) {
        $this->typeplace = $typeplace;

        return $this;
    }

    /**
     * Get typeplace
     *
     * @return string
     */
    public function getTypeplace() {
        return $this->typeplace;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Place
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
     * @return Place
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

    /**
     * Add transfer
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfer
     *
     * @return Place
     */
    public function addTransfer(\Daiquiri\AdminBundle\Entity\Transfer $transfer) {
        $this->transfers[] = $transfer;

        return $this;
    }

    /**
     * Remove transfer
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfer
     */
    public function removeTransfer(\Daiquiri\AdminBundle\Entity\Transfer $transfer) {
        $this->transfers->removeElement($transfer);
    }

    /**
     * Get transfers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransfers() {
        return $this->transfers;
    }

    /**
     * Add excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return Place
     */
    public function addExcursion(\Daiquiri\AdminBundle\Entity\Excursion $excursion) {
        $this->excursions[] = $excursion;

        return $this;
    }

    /**
     * Remove excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     */
    public function removeExcursion(\Daiquiri\AdminBundle\Entity\Excursion $excursion) {
        $this->excursions->removeElement($excursion);
    }

    /**
     * Get excursions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExcursions() {
        return $this->excursions;
    }

    /**
     * Add circuitDay
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay
     *
     * @return Place
     */
    public function addCircuitDay(\Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay) {
        $this->circuit_days[] = $circuitDay;

        return $this;
    }

    /**
     * Remove circuitDay
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay
     */
    public function removeCircuitDay(\Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay) {
        $this->circuit_days->removeElement($circuitDay);
    }

    /**
     * Get circuitDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuitDays() {
        return $this->circuit_days;
    }

    /**
     * Set polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     *
     * @return Place
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
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Place
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
     * @return Place
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

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Place
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
     * Add placetype
     *
     * @param \Daiquiri\AdminBundle\Entity\PlaceType $placetype
     *
     * @return Place
     */
    public function addPlacetype(\Daiquiri\AdminBundle\Entity\PlaceType $placetype) {
        $this->placetypes[] = $placetype;

        return $this;
    }

    /**
     * Remove placetype
     *
     * @param \Daiquiri\AdminBundle\Entity\PlaceType $placetype
     */
    public function removePlacetype(\Daiquiri\AdminBundle\Entity\PlaceType $placetype) {
        $this->placetypes->removeElement($placetype);
    }

    /**
     * Get placetypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlacetypes() {
        return $this->placetypes;
    }

    public function hasPlaceType(\Daiquiri\AdminBundle\Entity\PlaceType $placetype) {
        //dump($placetype);die;
        foreach ($this->placetypes as $type) {
            if ($type->getId() == $placetype->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set ispickupplaceExcursion
     *
     * @param boolean $ispickupplaceExcursion
     *
     * @return Place
     */
    public function setIspickupplaceExcursion($ispickupplaceExcursion) {
        $this->ispickupplace_excursion = $ispickupplaceExcursion;

        return $this;
    }

    /**
     * Get ispickupplaceExcursion
     *
     * @return boolean
     */
    public function getIspickupplaceExcursion() {
        return $this->ispickupplace_excursion;
    }

    /**
     * Set ispickupplaceTransfer
     *
     * @param boolean $ispickupplaceTransfer
     *
     * @return Place
     */
    public function setIspickupplaceTransfer($ispickupplaceTransfer) {
        $this->ispickupplace_transfer = $ispickupplaceTransfer;

        return $this;
    }

    /**
     * Get ispickupplaceTransfer
     *
     * @return boolean
     */
    public function getIspickupplaceTransfer() {
        return $this->ispickupplace_transfer;
    }

    /**
     * Set ispickupplaceCircuit
     *
     * @param boolean $ispickupplaceCircuit
     *
     * @return Place
     */
    public function setIspickupplaceCircuit($ispickupplaceCircuit) {
        $this->ispickupplace_circuit = $ispickupplaceCircuit;

        return $this;
    }

    /**
     * Get ispickupplaceCircuit
     *
     * @return boolean
     */
    public function getIspickupplaceCircuit() {
        return $this->ispickupplace_circuit;
    }

    /**
     * Set ispickupplaceCar
     *
     * @param boolean $ispickupplaceCar
     *
     * @return Place
     */
    public function setIspickupplaceCar($ispickupplaceCar) {
        $this->ispickupplace_car = $ispickupplaceCar;

        return $this;
    }

    /**
     * Get ispickupplaceCar
     *
     * @return boolean
     */
    public function getIspickupplaceCar() {
        return $this->ispickupplace_car;
    }

    public function ispickupplacefor() {
        $pickupplace = "";
        if ($this->ispickupplace_car)
            $pickupplace.=" Car ";
        if ($this->ispickupplace_circuit)
            $pickupplace.=" Circuit ";
        if ($this->ispickupplace_excursion)
            $pickupplace.=" Excursion ";
        if ($this->ispickupplace_transfer)
            $pickupplace.=" Transfer ";
        return $pickupplace;
    }

    public function hasGoogleLocation() {
        if ($this->latitude == "" && $this->longitude == "")
            return false;
        return true;
    }

    /**
     * Set province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     *
     * @return Place
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

    public function containType($placetype) {
        if (count($this->placetypes) > 0) {
            foreach ($this->placetypes as $pt) {
                if (strtoupper($pt->getTitle()) == strtoupper($placetype)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function fullTitle() {
        return $this->title;
    }

    /**
     * Add transfersFrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfersFrom
     *
     * @return Place
     */
    public function addTransfersFrom(\Daiquiri\AdminBundle\Entity\Transfer $transfersFrom) {
        $this->transfers_from[] = $transfersFrom;

        return $this;
    }

    /**
     * Remove transfersFrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfersFrom
     */
    public function removeTransfersFrom(\Daiquiri\AdminBundle\Entity\Transfer $transfersFrom) {
        $this->transfers_from->removeElement($transfersFrom);
    }

    /**
     * Get transfersFrom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransfersFrom() {
        return $this->transfers_from;
    }

    /**
     * Add transfersTo
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfersTo
     *
     * @return Place
     */
    public function addTransfersTo(\Daiquiri\AdminBundle\Entity\Transfer $transfersTo) {
        $this->transfers_to[] = $transfersTo;

        return $this;
    }

    /**
     * Remove transfersTo
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfersTo
     */
    public function removeTransfersTo(\Daiquiri\AdminBundle\Entity\Transfer $transfersTo) {
        $this->transfers_to->removeElement($transfersTo);
    }

    /**
     * Get transfersTo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransfersTo() {
        return $this->transfers_to;
    }

    public function getIconClass() {
        return 'fa fa-map-marker';
    }

}
