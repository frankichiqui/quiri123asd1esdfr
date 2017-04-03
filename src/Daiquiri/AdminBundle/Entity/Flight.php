<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Flight
 *
 * @ORM\Table(name="flight", indexes={@ORM\Index(name="IDX_C257E60EEC141EF8", columns={"airline"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\FlightRepository")
 */
class Flight {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="flight_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
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
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Airline
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Airline", inversedBy="flights")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="airline", referencedColumnName="id")
     * })
     */
    private $airline;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Airport", inversedBy="flights")
     * @ORM\JoinTable(name="flights_airports")
     */
    private $airports;

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
     * @return Flight
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Flight
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
     * @return Flight
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
     * Set airline
     *
     * @param \Daiquiri\AdminBundle\Entity\Airline $airline
     *
     * @return Flight
     */
    public function setAirline(\Daiquiri\AdminBundle\Entity\Airline $airline = null) {
        $this->airline = $airline;

        return $this;
    }

    /**
     * Get airline
     *
     * @return \Daiquiri\AdminBundle\Entity\Airline
     */
    public function getAirline() {
        return $this->airline;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Flight
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
    public function __construct()
    {
        $this->airports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add airport
     *
     * @param \Daiquiri\AdminBundle\Entity\Airport $airport
     *
     * @return Flight
     */
    public function addAirport(\Daiquiri\AdminBundle\Entity\Airport $airport)
    {
        $this->airports[] = $airport;

        return $this;
    }

    /**
     * Remove airport
     *
     * @param \Daiquiri\AdminBundle\Entity\Airport $airport
     */
    public function removeAirport(\Daiquiri\AdminBundle\Entity\Airport $airport)
    {
        $this->airports->removeElement($airport);
    }

    /**
     * Get airports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAirports()
    {
        return $this->airports;
    }
}
