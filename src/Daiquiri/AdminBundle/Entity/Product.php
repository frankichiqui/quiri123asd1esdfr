<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="IDX_D34A04AD92C4739C", columns={"provider"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ProductRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"product"="Product","car"="Car","circuit"="Circuit","excursion"="Excursion","medical_service"="MedicalService","ocupation"="Ocupation","package_option"="PackageOption","transfer"="Transfer","rental_house_room"="RentalHouseRoom", "excursion_exclusive"="ExcursionExclusive","excursion_colective"="ExcursionColective","transfer_exclusive"="TransferExclusive","transfer_colective"="TransferColective"})
 */
class Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=2000, nullable=true)
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
     * @ORM\Column(name="description", type="string", length=20000, nullable=true)
     */
    private $description;

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
     * @var integer
     *
     * @ORM\Column(name="numbersales", type="integer", nullable=true, options={"default"=0})
     */
    private $numbersales;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payonline", type="boolean", nullable=true,options={"default"=false})
     */
    private $payonline;

   
    /**
     * @var boolean
     *
     * @ORM\Column(name="review_available", type="boolean", nullable=true)
     */
    private $reviewAvailable;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="remarks", type="string", length=2000, nullable=true)
     */
    private $remarks;

    /**
     * @var string
     * @ORM\Column(name="product_type", type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\ProductIncrement", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="product_increment", referencedColumnName="id")
     */
    private $product_increment;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\TermConditionProduct", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_condition_product", referencedColumnName="id")
     * })
     */
    private $term_condition_product;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CancelationProduct", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancelation_product", referencedColumnName="id")
     * })
     */
    private $cancelation_product;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Document", mappedBy="products")
     */
    private $documents;

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
     * @var \Daiquiri\AdminBundle\Entity\Provider
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Provider", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provider", referencedColumnName="id")
     * })
     */
    private $provider;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="products")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="ReviewProduct", mappedBy="product")
     */
    private $reviews;

    public function getReviewEvaluation() {
        $cant = 0;
        foreach ($this->reviews as $r) {
            if ($r->getVotes() == 5 || $r->getVotes() == 4) {
                $cant++;
            }
        }
        if ($this->reviews->count() > 0) {
            return ($cant / $this->reviews->count()) * 100;
        }
        return 0;
    }

    public function getAverageVotes() {
        $cant = 0;
        foreach ($this->reviews as $r) {
            $cant+=$r->getVotes();
        }
        if ($this->reviews->count() > 0) {
            return ($cant / $this->reviews->count());
        }
        return 0;
    }

    public function printStart() {
        $ave = $this->getAverageVotes();
        $num = explode('.', $ave);
        $salida = '';
        for ($i = 0; $i < $num[0]; $i++) {
            $salida.= '<li><i class="fa fa-star"></i></li>';
        }
        if (isset($num[1])) {
            $salida.= '<li><i class="fa fa-star-half-empty"></i></li>';
        }
        return $salida;
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
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
     * @return Product
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
     * Set title
     *
     * @param string $title
     *
     * @return Product
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
     * @return Product
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
     * Set available
     *
     * @param boolean $available
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set provider
     *
     * @param \Daiquiri\AdminBundle\Entity\Provider $provider
     *
     * @return Product
     */
    public function setProvider(\Daiquiri\AdminBundle\Entity\Provider $provider = null) {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Daiquiri\AdminBundle\Entity\Provider
     */
    public function getProvider() {
        return $this->provider;
    }

    public function getClassName() {
        $type = explode('\\', get_class($this));
        return end($type);
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Product
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
     * @return Product
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
     * Set reviewAvailable
     *
     * @param boolean $reviewAvailable
     *
     * @return Product
     */
    public function setReviewAvailable($reviewAvailable) {
        $this->reviewAvailable = $reviewAvailable;

        return $this;
    }

    /**
     * Get reviewAvailable
     *
     * @return boolean
     */
    public function getReviewAvailable() {
        return $this->reviewAvailable;
    }

    /**
     * Set termConditionProduct
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionProduct
     *
     * @return Product
     */
    public function setTermConditionProduct(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionProduct = null) {
        $this->term_condition_product = $termConditionProduct;

        return $this;
    }

    /**
     * Get termConditionProduct
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionProduct() {
        return $this->term_condition_product;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Product
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

    /**
     * Set cancelationProduct
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationProduct
     *
     * @return Product
     */
    public function setCancelationProduct(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationProduct = null) {
        $this->cancelation_product = $cancelationProduct;

        return $this;
    }

    /**
     * Get cancelationProduct
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationProduct() {
        return $this->cancelation_product;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productType = $this->getType();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set documents
     *
     * @param \Doctrine\Common\Collections\Collection $documents
     */
    public function setDocuments(\Doctrine\Common\Collections\Collection $documents = null) {
        if (count($documents) > 0) {
            foreach ($documents as $document) {
                $this->addDocument($document);
            }
        }

        return $this;
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return Product
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $document->addProduct($this);
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        $document->removeProduct($this);
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

    public function getType() {
        $type = explode('\\', get_class($this));
        $type = trim(preg_replace('/(?=[A-Z])/', ' ', end($type)));
        return $type;
    }

    /**
     * Set productType
     *
     * @param string $productType
     *
     * @return Product
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

    /**
     * Set productIncrement
     *
     * @param \Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement
     *
     * @return Product
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

    /**
     * Set numbersales
     *
     * @param integer $numbersales
     *
     * @return Product
     */
    public function setNumbersales($numbersales) {
        $this->numbersales = $numbersales;

        return $this;
    }

    /**
     * Get numbersales
     *
     * @return integer
     */
    public function getNumbersales() {
        return $this->numbersales;
    }

    public function incrementNumberofSale($number = 1) {
        $this->numbersales+=$number;
    }

    /**
     * Add tag
     *
     * @param \Daiquiri\AdminBundle\Entity\Tag $tag
     *
     * @return Product
     */
    public function addTag(\Daiquiri\AdminBundle\Entity\Tag $tag) {
        $tag->addProduct($this);
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Daiquiri\AdminBundle\Entity\Tag $tag
     */
    public function removeTag(\Daiquiri\AdminBundle\Entity\Tag $tag) {
        $tag->removeProduct($this);
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags() {
        return $this->tags;
    }

    public function getFromprice() {
        return 0;
    }

    /**
     * Add review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     *
     * @return Product
     */
    public function addReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     */
    public function removeReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews() {
        return $this->reviews;
    }

}
