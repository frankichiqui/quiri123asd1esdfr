<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Province
 *
 * @ORM\Table("province")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ProvinceRepository")
 */
class Province {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="province_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Polo", mappedBy="provinces")
     */
    private $polos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place", mappedBy="province", cascade={"all"}, orphanRemoval=true)
     */
    private $places;

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
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Country",  inversedBy="provinces", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="country", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Zone", mappedBy="province")
     */
    private $zones;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

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
     * @return Province
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
     * @return Province
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
     * Constructor
     */
    public function __construct() {

        $this->polos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Province
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
     * @return Province
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
     * Add polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     *
     * @return Province
     */
    public function addPolo(\Daiquiri\AdminBundle\Entity\Polo $polo) {
        $this->polos[] = $polo;

        return $this;
    }

    /**
     * Remove polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     */
    public function removePolo(\Daiquiri\AdminBundle\Entity\Polo $polo) {
        $this->polos->removeElement($polo);
    }

    public function hasPolo(\Daiquiri\AdminBundle\Entity\Polo $polo) {
        return $this->polos->contains($polo);
    }

    /**
     * Get polos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPolos() {
        return $this->polos;
    }

    /**
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return Province
     */
    public function addPlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     */
    public function removePlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places->removeElement($place);
    }

    public function hasPlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        return $this->places->contains($place);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaces() {
        return $this->places;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Province
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
     * @return Province
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
     * Set country
     *
     * @param \Daiquiri\AdminBundle\Entity\Country $country
     *
     * @return Province
     */
    public function setCountry(\Daiquiri\AdminBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Daiquiri\AdminBundle\Entity\Country
     */
    public function getCountry() {
        return $this->country;
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
     * Set priority
     *
     * @param integer $priority
     *
     * @return Province
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
     * Add zone
     *
     * @param \Daiquiri\AdminBundle\Entity\Zone $zone
     *
     * @return Province
     */
    public function addZone(\Daiquiri\AdminBundle\Entity\Zone $zone) {
        $this->zones[] = $zone;

        return $this;
    }

    /**
     * Remove zone
     *
     * @param \Daiquiri\AdminBundle\Entity\Zone $zone
     */
    public function removeZone(\Daiquiri\AdminBundle\Entity\Zone $zone) {
        $this->zones->removeElement($zone);
    }

    public function hasZone(\Daiquiri\AdminBundle\Entity\Zone $zone) {
        return $this->zones->contains($zone);
    }

    /**
     * Get zones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZones() {
        return $this->zones;
    }

}
