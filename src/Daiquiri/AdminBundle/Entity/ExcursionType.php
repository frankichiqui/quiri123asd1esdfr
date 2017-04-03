<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ExcursionType
 *
 * @ORM\Table(name="excursion_type")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ExcursionTypeRepository")
 */
class ExcursionType {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="excursion_type_id_seq", allocationSize=1, initialValue=1)
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
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
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
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Excursion", mappedBy="excursionTypes")
     * @var \Doctrine\Common\Collections\Collection
     *  
     */
    private $excursions;

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
     * @return ExcursionType
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
        $this->excursions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ExcursionType
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
     * @return ExcursionType
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
     * Add excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return ExcursionType
     */
    public function addExcursion(\Daiquiri\AdminBundle\Entity\Excursion $excursion) {
        $this->excursions[] = $excursion;

        return $this;
    }

    /**
     * Remove excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     */
    public function removeExcursion(\Daiquiri\AdminBundle\Entity\Excursion $excursion) {
        $this->excursions->removeElement($excursion);
    }

    /**
     * Get excursions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExcursions() {
        return $this->excursions;
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
     * @return ExcursionType
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
}
