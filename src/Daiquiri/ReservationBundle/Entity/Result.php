<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Result {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Searcher", cascade={"all"}, fetch="EAGER",inversedBy="results")
     */
    private $searcher;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime" , nullable=true)
     */
    private $createAt;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string" , nullable=true)
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime")
     */
    protected $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime",nullable=true)
     */
    protected $enddate;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer",nullable=true)
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer",nullable=true)
     */
    private $kids;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="pickupplace", referencedColumnName="id", onDelete="SET NULL")
     */
    private $pickupplace;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="dropoffplace_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $dropoffplace;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Market")
     * @ORM\JoinColumn(name="market", referencedColumnName="id", onDelete="SET NULL")
     */
    private $market;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Product")
     * @ORM\JoinColumn(name="obj", referencedColumnName="id", onDelete="SET NULL")
     */
    private $obj;

    /**
     * @var integer
     *
     * @ORM\Column(name="infant", type="integer",nullable=true)
     */
    private $infants;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Flight")
     * @ORM\JoinColumn(name="flight", referencedColumnName="id", onDelete="SET NULL")
     */
    private $flight;

    /**
     * @var string
     *
     * @ORM\Column(name="passengers", type="integer",nullable=true)
     */
    private $passengers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pickup_time", type="date",nullable=true)
     */
    private $pickup_time;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set searcher
     *
     * @param \Daiquiri\ReservationBundle\Entity\Searcher $searcher
     *
     * @return Result
     */
    public function setSearcher(\Daiquiri\ReservationBundle\Entity\Searcher $searcher = null) {
        $this->searcher = $searcher;

        return $this;
    }

    /**
     * Get searcher
     *
     * @return \Daiquiri\ReservationBundle\Entity\Searcher
     */
    public function getSearcher() {
        return $this->searcher;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Result
     */
    public function setCreateAt($createAt) {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt() {
        return $this->createAt;
    }

    /**
     * Set product
     *
     * @param string $product
     *
     * @return Result
     */
    public function setProduct($product) {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Result
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
     * @return Result
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

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return Result
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
     * @return Result
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
     * Set infants
     *
     * @param integer $infants
     *
     * @return Result
     */
    public function setInfants($infants) {
        $this->infants = $infants;

        return $this;
    }

    /**
     * Get infants
     *
     * @return integer
     */
    public function getInfants() {
        return $this->infants;
    }

    /**
     * Set passengers
     *
     * @param integer $passengers
     *
     * @return Result
     */
    public function setPassengers($passengers) {
        $this->passengers = $passengers;

        return $this;
    }

    /**
     * Get passengers
     *
     * @return integer
     */
    public function getPassengers() {
        return $this->passengers;
    }

    /**
     * Set pickupTime
     *
     * @param \DateTime $pickupTime
     *
     * @return Result
     */
    public function setPickupTime($pickupTime) {
        $this->pickup_time = $pickupTime;

        return $this;
    }

    /**
     * Get pickupTime
     *
     * @return \DateTime
     */
    public function getPickupTime() {
        return $this->pickup_time;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return Result
     */
    public function setPickupplace(\Daiquiri\AdminBundle\Entity\Place $pickupplace = null) {
        $this->pickupplace = $pickupplace;

        return $this;
    }

    /**
     * Get pickupplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPickupplace() {
        return $this->pickupplace;
    }

    /**
     * Set dropoffplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $dropoffplace
     *
     * @return Result
     */
    public function setDropoffplace(\Daiquiri\AdminBundle\Entity\Place $dropoffplace = null) {
        $this->dropoffplace = $dropoffplace;

        return $this;
    }

    /**
     * Get dropoffplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getDropoffplace() {
        return $this->dropoffplace;
    }

    /**
     * Set flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     *
     * @return Result
     */
    public function setFlight(\Daiquiri\AdminBundle\Entity\Flight $flight = null) {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return \Daiquiri\AdminBundle\Entity\Flight
     */
    public function getFlight() {
        return $this->flight;
    }

    /**
     * Set market
     *
     * @param \Daiquiri\AdminBundle\Entity\Market $market
     *
     * @return Result
     */
    public function setMarket(\Daiquiri\AdminBundle\Entity\Market $market = null) {
        $this->market = $market;

        return $this;
    }

    /**
     * Get market
     *
     * @return \Daiquiri\AdminBundle\Entity\Market
     */
    public function getMarket() {
        return $this->market;
    }

    /**
     * Set obj
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $obj
     *
     * @return Result
     */
    public function setObj(\Daiquiri\AdminBundle\Entity\Product $obj = null) {
        $this->obj = $obj;

        return $this;
    }

    /**
     * Get obj
     *
     * @return \Daiquiri\AdminBundle\Entity\Product
     */
    public function getObj() {
        return $this->obj;
    }

}
