<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suplement
 *
 * @ORM\Table(name="suplement", indexes={@ORM\Index(name="IDX_225D4664631066A6", columns={"hotelid"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\SuplementRepository")
 */
class Suplement {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="suplement_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="adultprice", type="float", nullable=true)
     */
    private $adultprice;

    /**
     * @var float
     *
     * @ORM\Column(name="kidprice", type="float", nullable=true)
     */
    private $kidprice;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Hotel", inversedBy="suplements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotelid", referencedColumnName="id")
     * })
     */
    private $hotel;

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
     * @return Suplement
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Suplement
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
     * Set adultprice
     *
     * @param float $adultprice
     *
     * @return Suplement
     */
    public function setAdultprice($adultprice) {
        $this->adultprice = $adultprice;

        return $this;
    }

    /**
     * Get adultprice
     *
     * @return float
     */
    public function getAdultprice() {
        return $this->adultprice;
    }

    /**
     * Set kidprice
     *
     * @param float $kidprice
     *
     * @return Suplement
     */
    public function setKidprice($kidprice) {
        $this->kidprice = $kidprice;

        return $this;
    }

    /**
     * Get kidprice
     *
     * @return float
     */
    public function getKidprice() {
        return $this->kidprice;
    }

    /**
     * Set season
     *
     * @param integer $season
     *
     * @return Suplement
     */
    public function setSeason($season) {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return integer
     */
    public function getSeason() {
        return $this->season;
    }

    /**
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Suplement
     */
    public function setHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel = null) {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Daiquiri\AdminBundle\Entity\Hotel
     */
    public function getHotel() {
        return $this->hotel;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    public function getTotalValue(Ocupation $o) {
        return (($o->getKids() * $this->kidprice) + ($o->getAdults() * $this->adultprice));
    }

}
