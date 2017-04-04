<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouseFacilityType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RentalHouseFacilityType {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="RentalHouseFacility", mappedBy="rentalhousefacilitytype" )
     */
    private $rentalhousefacility;

    /**
     * @ORM\OneToMany(targetEntity="HotelFacility", mappedBy="hotelfacilitytype")
     */
    private $hotelfacility;

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
     * @return RentalHouseFacilityType
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
     * Constructor
     */
    public function __construct() {
        $this->rentalhousefacility = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rentalhousefacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalhousefacility
     *
     * @return RentalHouseFacilityType
     */
    public function addRentalhousefacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalhousefacility) {
        $this->rentalhousefacility[] = $rentalhousefacility;

        return $this;
    }

    /**
     * Remove rentalhousefacility
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalhousefacility
     */
    public function removeRentalhousefacility(\Daiquiri\AdminBundle\Entity\RentalHouseFacility $rentalhousefacility) {
        $this->rentalhousefacility->removeElement($rentalhousefacility);
    }

    /**
     * Get rentalhousefacility
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalhousefacility() {
        return $this->rentalhousefacility;
    }

    /**
     * Add hotelfacility
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelFacility $hotelfacility
     *
     * @return RentalHouseFacilityType
     */
    public function addHotelfacility(\Daiquiri\AdminBundle\Entity\HotelFacility $hotelfacility) {
        $this->hotelfacility[] = $hotelfacility;

        return $this;
    }

    /**
     * Remove hotelfacility
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelFacility $hotelfacility
     */
    public function removeHotelfacility(\Daiquiri\AdminBundle\Entity\HotelFacility $hotelfacility) {
        $this->hotelfacility->removeElement($hotelfacility);
    }

    /**
     * Get hotelfacility
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotelfacility() {
        return $this->hotelfacility;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return RentalHouseFacilityType
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
     * @return RentalHouseFacilityType
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


    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return RentalHouseFacilityType
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}
