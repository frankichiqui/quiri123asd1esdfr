<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TermConditionProduct
 *
 * @ORM\Table(name="term_condition_product")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\TermConditionProductRepository")
 */
class TermConditionProduct {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="term_condition_product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=2000, nullable=true)
     */
    private $title;

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
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Product", mappedBy="term_condition_product")
     */
    private $products;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", mappedBy="term_condition_hotel")
     */
    private $hotels;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", mappedBy="term_condition_house")
     */
    private $houses;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Package", mappedBy="term_condition_package")
     */
    private $packages;

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
     * 
     * @return TermConditionProduct
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
     * @return TermConditionProduct
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
     * Add product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return TermConditionProduct
     */
    public function addProduct(\Daiquiri\AdminBundle\Entity\Product $product) {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     */
    public function removeProduct(\Daiquiri\AdminBundle\Entity\Product $product) {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return TermConditionProduct
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
     * @return TermConditionProduct
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
     * Set locale
     *
     * @param string $locale
     *
     * @return Product
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
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->packages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return TermConditionProduct
     */
    public function addHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel) {
        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     */
    public function removeHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel) {
        $this->hotels->removeElement($hotel);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotels() {
        return $this->hotels;
    }

    /**
     * Add house
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $house
     *
     * @return TermConditionProduct
     */
    public function addHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $house) {
        $this->houses[] = $house;

        return $this;
    }

    /**
     * Remove house
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $house
     */
    public function removeHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $house) {
        $this->houses->removeElement($house);
    }

    /**
     * Get houses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses() {
        return $this->houses;
    }

    /**
     * Add package
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $package
     *
     * @return TermConditionProduct
     */
    public function addPackage(\Daiquiri\AdminBundle\Entity\RentalHouse $package) {
        $this->packages[] = $package;

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $package
     */
    public function removePackage(\Daiquiri\AdminBundle\Entity\RentalHouse $package) {
        $this->packages->removeElement($package);
    }

    /**
     * Get packages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPackages() {
        return $this->packages;
    }

}
