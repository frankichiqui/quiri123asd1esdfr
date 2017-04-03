<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CircuitDay
 *
 * @ORM\Table(name="circuit_day")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CircuitDayRepository")
 */
class CircuitDay {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="include", type="string", length=2000, nullable=true)
     */
    private $include;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="notinclude", type="string", length=2000, nullable=true)
     */
    private $notinclude;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Circuit
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Circuit", inversedBy="circuit_days")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="circuit", referencedColumnName="id")
     * })
     */
    private $circuit;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place", inversedBy="circuit_days")
     * @ORM\JoinTable(name="circuits_days_places")
     *
     */
    private $places;

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
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id",onDelete="SET NULL")
     * })
     */
    private $picture;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", cascade={"all"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="gallery", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $gallery;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return CircuitDay
     */
    public function setDay($day) {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CircuitDay
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
     * @return CircuitDay
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
     * Set include
     *
     * @param string $include
     *
     * @return CircuitDay
     */
    public function setInclude($include) {
        $this->include = $include;

        return $this;
    }

    /**
     * Get include
     *
     * @return string
     */
    public function getInclude() {
        return $this->include;
    }

    /**
     * Set notinclude
     *
     * @param string $notinclude
     *
     * @return CircuitDay
     */
    public function setNotinclude($notinclude) {
        $this->notinclude = $notinclude;

        return $this;
    }

    /**
     * Get notinclude
     *
     * @return string
     */
    public function getNotinclude() {
        return $this->notinclude;
    }

    /**
     * Set circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return CircuitDay
     */
    public function setCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit = null) {
        $this->circuit = $circuit;

        return $this;
    }

    /**
     * Get circuit
     *
     * @return \Daiquiri\AdminBundle\Entity\Circuit
     */
    public function getCircuit() {
        return $this->circuit;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return CircuitDay
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
     * @return CircuitDay
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
     * @return CircuitDay
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
     * @return CircuitDay
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
        return ($this->getCircuit() . '-' . $this->getTitle()) ? : '';
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return CircuitDay
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
     * Constructor
     */
    public function __construct() {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return CircuitDay
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

    public function constainPlace(Place $place) {
        if (count($this->places) > 0) {
            foreach ($this->places as $p) {
                if ($p->getId() == $place->getId()) {
                    return true;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

}
