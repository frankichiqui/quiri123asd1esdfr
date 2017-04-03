<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CircuitAvailability
 *
 * @ORM\Table(name="circuit_availability")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CircuitAvailabilityRepository")
 */
class CircuitAvailability {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="circuit_availability_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Circuit", mappedBy="circuit_availabilitys")
     *
     *  @var \Doctrine\Common\Collections\Collection
     *
     */
    private $circuits;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CircuitAvailability
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
     * Constructor
     */
    public function __construct() {
        $this->circuits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return CircuitAvailability
     */
    public function addCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit) {
        $this->circuits[] = $circuit;

        return $this;
    }

    /**
     * Remove circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     */
    public function removeCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit) {
        $this->circuits->removeElement($circuit);
    }

    /**
     * Get circuits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuits() {
        return $this->circuits;
    }

    public function getCircuitsById($id) {
        foreach ($this->circuits as $c) {
            if ($c->getId() == $id) {
                return $d;
            }
        }
        return null;
    }

    public function __toString() {
        return ($this->date->format("M j, Y")) ? : '';
    }

}
