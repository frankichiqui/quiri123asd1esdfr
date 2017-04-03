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
class CircuitRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Circuit")
     * @ORM\JoinColumn(name="circuit", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $circuit;

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
     * @var integer
     *
     * @ORM\Column(name="ocupation", type="integer")
     */
    private $ocupation;

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
        return 'Circuit';
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CircuitRequest
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
     * Set circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return CircuitRequest
     */
    public function setCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit = null) {
        $this->circuit = $circuit;

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

    public function getFullInfo() {
        return 'Circuit : ' . $this->circuit .
                ' Departure: ' . $this->startdate->format('M j Y') .
                ' Adults: ' . $this->adult .
                ' Kids: ' . $this->kid;
    }

    /**
     * Set ocupation
     *
     * @param integer $ocupation
     *
     * @return CircuitRequest
     */
    public function setOcupation($ocupation) {
        $this->ocupation = $ocupation;

        return $this;
    }

    /**
     * Get ocupation
     *
     * @return integer
     */
    public function getOcupation() {
        return $this->ocupation;
    }

}
