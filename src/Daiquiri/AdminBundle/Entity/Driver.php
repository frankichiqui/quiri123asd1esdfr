<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Driver
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\DriverRepository")
 */
class Driver {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="date", nullable=true)
     */
    private $dateofbirth;

    /**
     * @var integer
     *
     * @ORM\Column(name="experienceyears", type="integer", nullable=true)
     */
    private $experienceyears;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", nullable=true)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", nullable=true)
     */
    private $phone2;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Car", inversedBy="drivers", cascade={"persist","refresh"})
     * @ORM\JoinTable(name="drivers_cars")
     */
    private $cars;

    /**
     * Constructor
     */
    public function __construct() {
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Driver
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Driver
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set experienceyears
     *
     * @param integer $experienceyears
     *
     * @return Driver
     */
    public function setExperienceyears($experienceyears) {
        $this->experienceyears = $experienceyears;

        return $this;
    }

    /**
     * Get experienceyears
     *
     * @return integer
     */
    public function getExperienceyears() {
        return $this->experienceyears;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Driver
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
     * Set email
     *
     * @param string $email
     *
     * @return Driver
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     *
     * @return Driver
     */
    public function setPhone1($phone1) {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string
     */
    public function getPhone1() {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     *
     * @return Driver
     */
    public function setPhone2($phone2) {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string
     */
    public function getPhone2() {
        return $this->phone2;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Driver
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
     * @return Driver
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
     * @return Driver
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
     * Add car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return Driver
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

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Driver
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
     * Set title
     *
     * @param string $title
     *
     * @return Driver
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
     * Set dateofbirth
     *
     * @param \DateTime $dateofbirth
     *
     * @return Driver
     */
    public function setDateofbirth($dateofbirth) {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Get dateofbirth
     *
     * @return \DateTime
     */
    public function getDateofbirth() {
        return $this->dateofbirth;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

}
