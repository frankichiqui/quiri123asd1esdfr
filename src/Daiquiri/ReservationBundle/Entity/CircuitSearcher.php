<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CircuitSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CircuitSearcher extends Searcher {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer", nullable=true)
     */
    private $days;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="nights", type="integer", nullable = true)
     */
    private $nights;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="betweendates", type="boolean", nullable = true)
     */
    private $betweendates;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Circuit")
     * @ORM\JoinColumn(name="circuit", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $circuit;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinTable(name="circuirsearcher_place",
     *      joinColumns={@ORM\JoinColumn(name="id_circuitsearcher", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_place", referencedColumnName="id")}
     *      )
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinColumn(name="polofromid", referencedColumnName="id")
     */
    private $polofrom;

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

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return CircuitSearcher
     */
    public function setDays($days) {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays() {
        return $this->days;
    }

    /**
     * Set nights
     *
     * @param integer $nights
     *
     * @return CircuitSearcher
     */
    public function setNights($nights) {
        $this->nights = $nights;

        return $this;
    }

    /**
     * Get nights
     *
     * @return integer
     */
    public function getNights() {
        return $this->nights;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CircuitSearcher
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
     * Set adults
     *
     * @param integer $adults
     *
     * @return CircuitSearcher
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
     * @return CircuitSearcher
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
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return CircuitSearcher
     */
    public function addPlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     */
    public function removePlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places->removeElement($place);
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CircuitSearcher
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

    public function __toString() {
        $salida = "Find Circuit in ";
        if ($this->date) {
            $salida .= $this->date->format('M j, Y');
        }

        if ($this->adults) {
            $salida .=" For " . $this->adults . " adult(s)";
        }
        if ($this->kids) {
            $salida .="  " . $this->kids . " kid(s)";
        }

        return $salida;
    }

    /**
     * Set places
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $places
     *
     * @return CircuitSearcher
     */
    public function setPlaces(\Daiquiri\AdminBundle\Entity\Place $places = null) {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPlaces() {
        return $this->places;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set betweendates
     *
     * @param boolean $betweendates
     *
     * @return CircuitSearcher
     */
    public function setBetweendates($betweendates) {
        $this->betweendates = $betweendates;

        return $this;
    }

    /**
     * Get betweendates
     *
     * @return boolean
     */
    public function getBetweendates() {
        return $this->betweendates;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="date", nullable=true)
     */
    private $createAt;

    /**
     * Set circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return CircuitSearcher
     */
    public function setCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit = null) {
        $this->circuit = $circuit;

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
     * Set polofrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polofrom
     *
     * @return Polo
     */
    public function setPolofrom(\Daiquiri\AdminBundle\Entity\Polo $polofrom = null) {
        $this->polofrom = $polofrom;

        return $this;
    }

    /**
     * Get circuit
     *
     * @return \Daiquiri\AdminBundle\Entity\Circuit
     */
    public function getCircuit() {
        return $this->circuit;
    }

}
