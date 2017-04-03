<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * LuggageCapacity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\LuggageCapacityRepository")
 */
class LuggageCapacity {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * 
     * @Gedmo\Slug(fields={"title"})
     * @Gedmo\Translatable
     * @ORM\Column(unique=true, nullable = false)
     * 
     * 
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Car", mappedBy="luggagecapacity")
     */
    private $cars;

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
     * @return LuggageCapacity
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
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return LuggageCapacity
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
     * @return LuggageCapacity
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
     * Add car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return LuggageCapacity
     */
    public function addCar(\Daiquiri\AdminBundle\Entity\Car $car) {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     */
    public function removeCar(\Daiquiri\AdminBundle\Entity\Car $car) {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCars() {
        return $this->cars;
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

}
