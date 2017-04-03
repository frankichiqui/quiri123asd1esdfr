<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Zone
 *
 * @ORM\Table(name="zone", indexes={@ORM\Index(name="IDX_A0EBC0074ADAD40B", columns={"province"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ZoneRepository")
 */
class Zone {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="zone_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", mappedBy="zone")
     */
    private $rental_houses;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Province
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Province", inversedBy="zones", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="province", referencedColumnName="id")
     * })
     */
    private $province;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", mappedBy="zone")
     */
    private $hotels;
    

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
        $this->rental_houses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotels =  new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Zone
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
     * @return Zone
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
     * @return Zone
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
     * Set description
     *
     * @param string $description
     *
     * @return Zone
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
     * Add rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     *
     * @return Zone
     */
    public function addRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse) {
        $this->rental_houses[] = $rentalHouse;

        return $this;
    }

    /**
     * Remove rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     */
    public function removeRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse) {
        $this->rental_houses->removeElement($rentalHouse);
    }

    /**
     * Get rentalHouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouses() {
        return $this->rental_houses;
    }

    /**
     * Set province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     *
     * @return Zone
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
     * @return Zone
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Zone
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Add hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Zone
     */
    public function addHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel)
    {
        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     */
    public function removeHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel)
    {
        $this->hotels->removeElement($hotel);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotels()
    {
        return $this->hotels;
    }
}
