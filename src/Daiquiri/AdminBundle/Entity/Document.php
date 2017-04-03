<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\DocumentRepository")
 */
class Document {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable = true)
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
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Product", inversedBy="documents", cascade={"persist"}) 
     * @ORM\JoinTable(name="documents_products")
     */
    private $products;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", inversedBy="documents", cascade={"persist"})
     * @ORM\JoinTable(name="documents_hotels")
     */
    private $hotels;
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", inversedBy="documents")
     * @ORM\JoinTable(name="documents_rentalhouse")
     */
    private $houses;
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Package", inversedBy="documents")
     * @ORM\JoinTable(name="documents_packages")
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
     * @return Document
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
     * @return Document
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
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->packages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Document
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
     * @return Document
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
     * Add product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return Document
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

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    /**
     * Add hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Document
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
     * @param \Daiquiri\AdminBundle\Entity\rentalHouse $house
     *
     * @return Document
     */
    public function addHouse(\Daiquiri\AdminBundle\Entity\rentalHouse $house)
    {
        $this->houses[] = $house;

        return $this;
    }

    /**
     * Remove house
     *
     * @param \Daiquiri\AdminBundle\Entity\rentalHouse $house
     */
    public function removeHouse(\Daiquiri\AdminBundle\Entity\rentalHouse $house)
    {
        $this->houses->removeElement($house);
    }

    /**
     * Get houses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses()
    {
        return $this->houses;
    }

    /**
     * Add package
     *
     * @param \Daiquiri\AdminBundle\Entity\rentalHouse $package
     *
     * @return Document
     */
    public function addPackage(\Daiquiri\AdminBundle\Entity\rentalHouse $package)
    {
        $this->packages[] = $package;

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Daiquiri\AdminBundle\Entity\rentalHouse $package
     */
    public function removePackage(\Daiquiri\AdminBundle\Entity\rentalHouse $package)
    {
        $this->packages->removeElement($package);
    }

    /**
     * Get packages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPackages()
    {
        return $this->packages;
    }
}
