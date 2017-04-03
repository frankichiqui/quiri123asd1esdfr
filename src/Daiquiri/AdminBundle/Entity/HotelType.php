<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * HotelType
 *
 * @ORM\Table(name="hotel_type")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\HotelTypeRepository")
 */
class HotelType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="hotel_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", mappedBy="hotelType")
     */
    private $hotels;
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return HotelType
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
     * Set description
     *
     * @param string $description
     *
     * @return HotelType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return HotelType
     */
    public function addHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel)
    {
        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     */
    public function removeHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel)
    {
        $this->hotels->removeElement($hotel);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotels()
    {
        return $this->hotels;
    }
    
    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ContactCause
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
     * @return HotelType
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
}
