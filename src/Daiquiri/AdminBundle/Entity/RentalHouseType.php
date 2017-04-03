<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouseType
 *
 * @ORM\Table(name="rental_house_type")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseTypeRepository")
 */
class RentalHouseType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", mappedBy="rental_house_type")
     */
    private $rental_houses;
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
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
    private $picture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rental_houses = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RentalHouseType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     *
     * @return RentalHouseType
     */
    public function addRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse)
    {
        $this->rental_houses[] = $rentalHouse;

        return $this;
    }

    /**
     * Remove rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     */
    public function removeRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse)
    {
        $this->rental_houses->removeElement($rentalHouse);
    }

    /**
     * Get rentalHouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouses()
    {
        return $this->rental_houses;
    }
    
    public function __toString() {
        return ($this->getTitle()) ? : '';
        
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return RentalHouseType
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return RentalHouseType
     */
    public function setUniqueSlug($uniqueSlug)
    {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug()
    {
        return $this->uniqueSlug;
    }
    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return RentalHouseType
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
     
}
