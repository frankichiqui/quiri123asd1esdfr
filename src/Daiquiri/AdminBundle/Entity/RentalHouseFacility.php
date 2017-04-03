<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouseFacility
 *
 * @ORM\Table(name="rental_house_facility")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseFacilityRepository")
 */
class RentalHouseFacility
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_facility_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="RentalHouseFacilityType", inversedBy="rentalhousefacility")
     * @ORM\JoinColumn(name="rentalhousefacilitytype_id", referencedColumnName="id")
     */
    private $rentalhousefacilitytype;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \Daiquiri\AdminBundle\Entity\RentalHouse
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", inversedBy="rental_house_facilities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rental_house", referencedColumnName="id")
     * })
     */
    private $rental_house;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RentalHouseFacility
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return RentalHouseFacility
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    
    public function __toString() {
        return ($this->getTitle()) ? : '';
        
    }
    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return RentalHouseFacility
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
     * @return RentalHouseFacility
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return RentalHouseFacility
     */
    public function setUniqueSlug($uniqueSlug)
    {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug()
    {
        return $this->uniqueSlug;
    }

    /**
     * Set rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     *
     * @return RentalHouseFacility
     */
    public function setRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse = null)
    {
        $this->rental_house = $rentalHouse;

        return $this;
    }

    /**
     * Get rentalHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouse
     */
    public function getRentalHouse()
    {
        return $this->rental_house;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return RentalHouseFacility
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
     * @return RentalHouseFacility
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
     * Set rentalhousefacilitytype
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $rentalhousefacilitytype
     *
     * @return RentalHouseFacility
     */
    public function setRentalhousefacilitytype(\Daiquiri\AdminBundle\Entity\RentalHouseFacilityType $rentalhousefacilitytype = null)
    {
        $this->rentalhousefacilitytype = $rentalhousefacilitytype;

        return $this;
    }

    /**
     * Get rentalhousefacilitytype
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouseFacilityType
     */
    public function getRentalhousefacilitytype()
    {
        return $this->rentalhousefacilitytype;
    }
}
