<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * 
 */
class ExcursionRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Excursion")
     * @ORM\JoinColumn(name="excursion", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $excursion;

    /**
     * @var integer
     *
     * @ORM\Column(name="adult", type="integer")
     */
    private $adult;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid", type="integer")
     */
    private $kid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * Set adult
     *
     * @param integer $adult
     *
     * @return RentalHouseRequest
     */
    public function setAdult($adult) {
        $this->adult = $adult;

        return $this;
    }

    /**
     * Get adult
     *
     * @return integer
     */
    public function getAdult() {
        return $this->adult;
    }

    /**
     * Set kid
     *
     * @param integer $kid
     *
     * @return RentalHouseRequest
     */
    public function setKid($kid) {
        $this->kid = $kid;

        return $this;
    }

    /**
     * Get kid
     *
     * @return integer
     */
    public function getKid() {
        return $this->kid;
    }

    public static function getRootViewFolder() {
        return 'Excursion';
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return ExcursionColectiveRequest
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
     * Set excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return ExcursionRequest
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

    public function getFullInfo() {
        return ' '.$this->excursion->getTipo() . $this->excursion .
                ' Departure: ' . $this->startdate->format('M j Y') .
                ' Adults: ' . $this->adult .
                ' Kids: ' . $this->kid;
    }

}
