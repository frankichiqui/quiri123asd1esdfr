<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Polo
 *
 * @ORM\Table(name="polo")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\PoloRepository")
 */
class Polo {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="polo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
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
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place", mappedBy="polo")
     */
    private $places;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Province", inversedBy="polos")
     * @ORM\JoinTable(name="polos_provinces")
     */
    private $provinces;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Circuit", mappedBy="polofrom")
     */
    private $circuits;

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
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Excursion", mappedBy="polofrom", cascade={"all"}, orphanRemoval=true)
     */
    private $excursions;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\PackageOption", mappedBy="polos")
     */
    private $package_options;

    /**
     * Constructor
     */
    public function __construct() {
        $this->excursions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->package_options = new \Doctrine\Common\Collections\ArrayCollection();
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
        $this->province = new \Doctrine\Common\Collections\ArrayCollection();
        $this->circuits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Polo
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
     * @return Polo
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
     * Set priority
     *
     * @param integer $priority
     *
     * @return Polo
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
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return Polo
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

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaces() {
        return $this->places;
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Polo
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
     * @return Polo
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
     * @return Polo
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
     * @return Polo
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
     * Add province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     *
     * @return Polo
     */
    public function addProvince(\Daiquiri\AdminBundle\Entity\Province $province) {
        $this->provinces[] = $province;

        return $this;
    }

    /**
     * Remove province
     *
     * @param \Daiquiri\AdminBundle\Entity\Province $province
     */
    public function removeProvince(\Daiquiri\AdminBundle\Entity\Province $province) {
        $this->provinces->removeElement($province);
    }

    public function hasProvince(\Daiquiri\AdminBundle\Entity\Province $province) {
        return $this->provinces->contains($province);
    }

    /**
     * Get provinces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProvinces() {
        return $this->provinces;
    }

    /**
     * Add packageOption
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $packageOption
     *
     * @return Polo
     */
    public function addPackageOption(\Daiquiri\AdminBundle\Entity\PackageOption $packageOption) {
        $this->package_options[] = $packageOption;

        return $this;
    }

    /**
     * Remove packageOption
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $packageOption
     */
    public function removePackageOption(\Daiquiri\AdminBundle\Entity\PackageOption $packageOption) {
        $this->package_options->removeElement($packageOption);
    }

    /**
     * Get packageOptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPackageOptions() {
        return $this->package_options;
    }

    /**
     * Add excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return Polo
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
     * Add circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return Polo
     */
    public function addCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit) {
        $this->circuits[] = $circuit;

        return $this;
    }

    /**
     * Remove circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     */
    public function removeCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit) {
        $this->circuits->removeElement($circuit);
    }

    /**
     * Get circuits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuits() {
        return $this->circuits;
    }

}
