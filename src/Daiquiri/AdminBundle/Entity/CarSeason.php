<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CircuitSeason
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class CarSeason {

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

     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

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
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Car", inversedBy="carseason")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
     */
    private $car;

    /**
     * Set car
     *
     * @param Car $car
     *
     * @return Car
     */
    public function setCar($car) {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return Car
     */
    public function getCar() {
        return $this->car;
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

    public function __toString() {
        return ($this->getCar() . ' (' . $this->getStartdate()->format('M j, Y'). ' to ' . $this->getEnddate()->format('M j, Y') . ' ) -' . $this->getTitle()) ? : '';
    }

    /**
     * Constructor
     */
    public function __construct() {
        
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
        if (count($this->circuit_season_days) > 0) {
            foreach ($this->circuit_season_days as $d) {
                if ($d->getDate()->format('Y-m-d') == $date->format('Y-m-d')) {
                    return TRUE;
                }
            }
        }
        return false;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return CarSeason
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

}
