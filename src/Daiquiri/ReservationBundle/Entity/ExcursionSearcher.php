<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExcursionSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ExcursionSearcher extends Searcher {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinColumn(name="polo", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $polo;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Excursion")
     * @ORM\JoinColumn(name="excursion", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $excursion;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinColumn(name="polofrom", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $polofrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\ExcursionType")
     * @ORM\JoinTable(name="excursion_searcher_excursion_type",
     *      joinColumns={@ORM\JoinColumn(name="excursion_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="excursion_type_id", referencedColumnName="id")}
     *      )
     */
    private $types;

    /**
     * @var integer
     *
     * @ORM\Column(name="exclusive", type="boolean")
     */
    private $exclusive;
    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinTable(name="excursion_searcher_excursion_place",
     *      joinColumns={@ORM\JoinColumn(name="excursion_searcher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="excursion_place_id", referencedColumnName="id")}
     *      )
     */   
    private $places;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;

    

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ExcursionSearcher
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set exclusive
     *
     * @param boolean $exclusive
     *
     * @return ExcursionSearcher
     */
    public function setExclusive($exclusive) {
        $this->exclusive = $exclusive;

        return $this;
    }

    /**
     * Get exclusive
     *
     * @return boolean
     */
    public function getExclusive() {
        return $this->exclusive;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return ExcursionSearcher
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return ExcursionSearcher
     */
    public function setAdults($adults) {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults() {
        return $this->adults;
    }

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return ExcursionSearcher
     */
    public function setKids($kids) {
        $this->kids = $kids;

        return $this;
    }

    /**
     * Get kids
     *
     * @return integer
     */
    public function getKids() {
        return $this->kids;
    }

    /**
     * Set polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     *
     * @return ExcursionSearcher
     */
    public function setPolo(\Daiquiri\AdminBundle\Entity\Polo $polo = null) {
        $this->polo = $polo;

        return $this;
    }

    /**
     * Get polo
     *
     * @return \Daiquiri\AdminBundle\Entity\Polo
     */
    public function getPolo() {
        return $this->polo;
    }

   

    /**
     * Set polofrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polofrom
     *
     * @return ExcursionSearcher
     */
    public function setPolofrom(\Daiquiri\AdminBundle\Entity\Polo $polofrom = null) {
        $this->polofrom = $polofrom;

        return $this;
    }

    /**
     * Get polofrom
     *
     * @return \Daiquiri\AdminBundle\Entity\Polo
     */
    public function getPolofrom() {
        return $this->polofrom;
    }

    /**
     * Add type
     *
     * @param \Daiquiri\AdminBundle\Entity\ExcursionType $type
     *
     * @return ExcursionSearcher
     */
    public function addType(\Daiquiri\AdminBundle\Entity\ExcursionType $type) {
        $this->types[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \Daiquiri\AdminBundle\Entity\ExcursionType $type
     */
    public function removeType(\Daiquiri\AdminBundle\Entity\ExcursionType $type) {
        $this->types->removeElement($type);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypes() {
        return $this->types;
    }

    public function __toString() {

        $salida = "Search Excursion ";
        if ($this->exclusive) {
            $salida.= " Exclusive ";
        } else {
            $salida .= " Colective ";
        }
        if ($this->date) {
            $salida .= " Departure " . $this->date->format("M j, Y");
        }
        return $salida;
    }

    /**
     * Set excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return ExcursionSearcher
     */
    public function setExcursion(\Daiquiri\AdminBundle\Entity\Excursion $excursion = null) {
        $this->excursion = $excursion;

        return $this;
    }

    /**
     * Get excursion
     *
     * @return \Daiquiri\AdminBundle\Entity\Excursion
     */
    public function getExcursion() {
        return $this->excursion;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return ExcursionSearcher
     */
    public function addPlace(\Daiquiri\AdminBundle\Entity\Place $place)
    {
        $this->places[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     */
    public function removePlace(\Daiquiri\AdminBundle\Entity\Place $place)
    {
        $this->places->removeElement($place);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaces()
    {
        return $this->places;
    }
}
