<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CircuitSeason
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CircuitSeasonRepository")
 */
class CircuitSeason {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="adult_price", type="float", nullable=true)
     */
    private $adultPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="kid_price", type="float", nullable=true)
     */
    private $kidPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="adult_price_doble", type="float", nullable=true)
     */
    private $adultPriceDoble;

    /**
     * @var float
     *
     * @ORM\Column(name="kid_price_doble", type="float", nullable=true)
     */
    private $kidPriceDoble;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Circuit", inversedBy="circuit_seasons")
     * @ORM\JoinColumn(name="circuit_id", referencedColumnName="id")
     */   
    
    
    private $circuit;

    /**
     * Set circuit
     *
     * @param Circuit $circuit
     *
     * @return CircuitSeason
     */
    public function setCircuit($circuit) {
        $this->circuit = $circuit;

        return $this;
    }

    /**
     * Get circuit
     *
     * @return Circuit
     */
    public function getCircuit() {
        return $this->circuit;
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
     * Set title
     *
     * @param string $title
     *
     * @return CircuitSeason
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
     * Set adultPrice
     *
     * @param float $adultPrice
     *
     * @return CircuitSeason
     */
    public function setAdultPrice($adultPrice) {
        $this->adultPrice = $adultPrice;

        return $this;
    }

    /**
     * Get adultPrice
     *
     * @return float
     */
    public function getAdultPrice() {
        return $this->adultPrice;
    }

    /**
     * Set kidPrice
     *
     * @param float $kidPrice
     *
     * @return CircuitSeason
     */
    public function setKidPrice($kidPrice) {
        $this->kidPrice = $kidPrice;

        return $this;
    }

    /**
     * Get kidPrice
     *
     * @return float
     */
    public function getKidPrice() {
        return $this->kidPrice;
    }

    public function __toString() {
        return ('-' . $this->getTitle()) ? : '';
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CircuitSeason
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return CircuitSeason
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate() {
        return $this->enddate;
    }

    public function constainDate(\DateTime $date) {
        if ($date >= $this->startdate && $date <= $this->enddate) {
            return true;
        }
        return false;
    }

    /**
     * Set adultPriceDoble
     *
     * @param float $adultPriceDoble
     *
     * @return CircuitSeason
     */
    public function setAdultPriceDoble($adultPriceDoble) {
        $this->adultPriceDoble = $adultPriceDoble;

        return $this;
    }

    /**
     * Get adultPriceDoble
     *
     * @return float
     */
    public function getAdultPriceDoble() {
        return $this->adultPriceDoble;
    }

    /**
     * Set kidPriceDoble
     *
     * @param float $kidPriceDoble
     *
     * @return CircuitSeason
     */
    public function setKidPriceDoble($kidPriceDoble) {
        $this->kidPriceDoble = $kidPriceDoble;

        return $this;
    }

    /**
     * Get kidPriceDoble
     *
     * @return float
     */
    public function getKidPriceDoble() {
        return $this->kidPriceDoble;
    }

}
