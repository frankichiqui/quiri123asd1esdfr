<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Gender
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gender
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="gender_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\ServicePax", mappedBy="gender")
     */
    private $service_paxs;

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
        $this->service_paxs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Gender
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
     * Add servicePax
     *
     * @param \Daiquiri\ReservationBundle\Entity\ServicePax $servicePax
     *
     * @return Gender
     */
    public function addServicePax(\Daiquiri\ReservationBundle\Entity\ServicePax $servicePax)
    {
        $this->service_paxs[] = $servicePax;

        return $this;
    }

    /**
     * Remove servicePax
     *
     * @param \Daiquiri\ReservationBundle\Entity\ServicePax $servicePax
     */
    public function removeServicePax(\Daiquiri\ReservationBundle\Entity\ServicePax $servicePax)
    {
        $this->service_paxs->removeElement($servicePax);
    }

    /**
     * Get servicePaxs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServicePaxs()
    {
        return $this->service_paxs;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Gender
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
     * @return Gender
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

    public function __toString(){
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
