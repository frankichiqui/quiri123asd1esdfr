<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Package
 *
 * @ORM\Table(name="package")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\PackageRepository")
 */
class Package {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="package_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     * description
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\PackageOption", mappedBy="package", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    private $package_options;

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
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean", nullable=true)
     */
    private $available;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payonline", type="boolean", nullable=true)
     */
    private $payonline;

   
    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\TermConditionProduct", inversedBy="packages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_condition_package", referencedColumnName="id")
     * })
     */
    private $term_condition_package;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CancelationProduct", inversedBy="packages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancelation_packages", referencedColumnName="id")
     * })
     */
    private $cancelation_package;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Document", mappedBy="packages")
     */
    private $documents;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="remarks", type="string", length=2000, nullable=true)
     */
    private $remarks;

    /**
     * @ORM\ManyToOne(targetEntity="ProductIncrement", inversedBy="packages", cascade={"persist"})
     * @ORM\JoinColumn(name="product_increment", referencedColumnName="id")
     */
    private $product_increment;

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
     * @return Package
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
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Package
     */
    public function setRemarks($remarks) {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks() {
        return $this->remarks;
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
     * Set description
     *
     * @param string $description
     *
     * @return Package
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
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Package
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
     * @return Package
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
     * Constructor
     */
    public function __construct() {
        $this->package_options = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add packageOption
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $packageOption
     *
     * @return Package
     */
    public function addPackageOption(\Daiquiri\AdminBundle\Entity\PackageOption $packageOption) {
        $packageOption->setPackage($this);
        $this->package_options[] = $packageOption;

        return $this;
    }

    /**
     * Remove packageOption
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $packageOption
     */
    public function removePackageOption(\Daiquiri\AdminBundle\Entity\PackageOption $packageOption) {
        $packageOption->setPackage(null);
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
     * set packageOptions
     *
     * @param \Doctrine\Common\Collections\Collection $packageOptions
     */
    public function setPackageOptions(\Doctrine\Common\Collections\Collection $packageOptions) {
        if (count($packageOptions) > 0) {
            foreach ($packageOptions as $option) {
                $this->addPackageOption($option);
            }
        }

        return $this;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Package
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
     * @return Package
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
     * Set available
     *
     * @param boolean $available
     *
     * @return Package
     */
    public function setAvailable($available) {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        return $this->available;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Package
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
     * Set payonline
     *
     * @param boolean $payonline
     *
     * @return Package
     */
    public function setPayonline($payonline) {
        $this->payonline = $payonline;

        return $this;
    }

    /**
     * Get payonline
     *
     * @return boolean
     */
    public function getPayonline() {
        return $this->payonline;
    }

   

    

    /**
     * Set termConditionPackage
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionPackage
     *
     * @return Package
     */
    public function setTermConditionPackage(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionPackage = null) {
        $this->term_condition_package = $termConditionPackage;

        return $this;
    }

    /**
     * Get termConditionPackage
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionPackage() {
        return $this->term_condition_package;
    }

    /**
     * Set cancelationPackage
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationPackage
     *
     * @return Package
     */
    public function setCancelationPackage(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationPackage = null) {
        $this->cancelation_package = $cancelationPackage;

        return $this;
    }

    /**
     * Get cancelationPackage
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationPackage() {
        return $this->cancelation_package;
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return Package
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments() {
        return $this->documents;
    }

    /**
     * Set productIncrement
     *
     * @param \Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement
     *
     * @return Package
     */
    public function setProductIncrement(\Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement = null) {
        $this->product_increment = $productIncrement;

        return $this;
    }

    /**
     * Get productIncrement
     *
     * @return \Daiquiri\AdminBundle\Entity\ProductIncrement
     */
    public function getProductIncrement() {
        return $this->product_increment;
    }

}
