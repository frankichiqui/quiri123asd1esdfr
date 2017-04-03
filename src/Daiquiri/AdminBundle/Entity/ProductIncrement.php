<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductIncrement
 *
 * @ORM\Table(name="product_increment")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ProductIncrementRepository")
 */
class ProductIncrement {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="increment", type="float", options={"default"=0}, nullable=true)
     */
    private $increment;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_type", type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Product", mappedBy="product_increment")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", mappedBy="product_increment")
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", mappedBy="product_increment")
     */
    private $rentalhouses;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Package", mappedBy="product_increment")
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
     * Set increment
     *
     * @param float $increment
     *
     * @return ProductIncrement
     */
    public function setIncrement($increment) {
        $this->increment = $increment;

        return $this;
    }

    /**
     * Get increment
     *
     * @return float
     */
    public function getIncrement() {
        return $this->increment;
    }

    /**
     * Set productType
     *
     * @param string $productType
     *
     * @return ProductIncrement
     */
    public function setProductType($productType) {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return string
     */
    public function getProductType() {
        return $this->productType;
    }

    public function __toString() {
        return $this->productType . ' - ' . $this->increment . '%';
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return ProductIncrement
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
     * Add hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return ProductIncrement
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
     * Add rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     *
     * @return ProductIncrement
     */
    public function addRentalhouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse) {
        $this->rentalhouses[] = $rentalhouse;

        return $this;
    }

    /**
     * Remove rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     */
    public function removeRentalhouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse) {
        $this->rentalhouses->removeElement($rentalhouse);
    }

    /**
     * Get rentalhouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalhouses() {
        return $this->rentalhouses;
    }

    /**
     * Add package
     *
     * @param \Daiquiri\AdminBundle\Entity\Package $package
     *
     * @return ProductIncrement
     */
    public function addPackage(\Daiquiri\AdminBundle\Entity\Package $package) {
        $this->packages[] = $package;

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Daiquiri\AdminBundle\Entity\Package $package
     */
    public function removePackage(\Daiquiri\AdminBundle\Entity\Package $package) {
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
