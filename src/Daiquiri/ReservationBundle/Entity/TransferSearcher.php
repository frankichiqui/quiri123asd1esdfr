<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransferSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TransferSearcher extends Searcher {

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
     * @ORM\JoinColumn(name="polofrom", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $polofrom;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinColumn(name="poloto", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $poloto;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Transfer")
     * @ORM\JoinColumn(name="transfer", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $transfer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exclusive", type="integer", nullable = true)
     */
    private $exclusive;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="placefrom", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $placefrom;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="placeto", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $placeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="passengers", type="integer")
     */
    private $passengers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date", nullable=true)
     */
    private $startdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="roundtrip", type="boolean")
     */
    private $roundtrip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateroundtrip", type="date")
     */
    private $dateroundtrip;

    /**
     * Set exclusive
     *
     * @param boolean $exclusive
     *
     * @return TransferSearcher
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
     * Set passengers
     *
     * @param integer $passengers
     *
     * @return TransferSearcher
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TransferSearcher
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
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return TransferSearcher
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
     * Set roundtrip
     *
     * @param boolean $roundtrip
     *
     * @return TransferSearcher
     */
    public function setRoundtrip($roundtrip) {
        $this->roundtrip = $roundtrip;

        return $this;
    }

    /**
     * Get roundtrip
     *
     * @return boolean
     */
    public function getRoundtrip() {
        return $this->roundtrip;
    }

    /**
     * Set dateroundtrip
     *
     * @param \DateTime $dateroundtrip
     *
     * @return TransferSearcher
     */
    public function setDateroundtrip($dateroundtrip) {
        $this->dateroundtrip = $dateroundtrip;

        return $this;
    }

    /**
     * Get dateroundtrip
     *
     * @return \DateTime
     */
    public function getDateroundtrip() {
        return $this->dateroundtrip;
    }

    /**
     * Set polofrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polofrom
     *
     * @return TransferSearcher
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
     * Set poloto
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $poloto
     *
     * @return TransferSearcher
     */
    public function setPoloto(\Daiquiri\AdminBundle\Entity\Polo $poloto = null) {
        $this->poloto = $poloto;

        return $this;
    }

    /**
     * Get poloto
     *
     * @return \Daiquiri\AdminBundle\Entity\Polo
     */
    public function getPoloto() {
        return $this->poloto;
    }

    /**
     * Set placefrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $placefrom
     *
     * @return TransferSearcher
     */
    public function setPlacefrom(\Daiquiri\AdminBundle\Entity\Place $placefrom = null) {
        $this->placefrom = $placefrom;

        return $this;
    }

    /**
     * Get placefrom
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPlacefrom() {
        return $this->placefrom;
    }

    /**
     * Set placeto
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $placeto
     *
     * @return TransferSearcher
     */
    public function setPlaceto(\Daiquiri\AdminBundle\Entity\Place $placeto = null) {
        $this->placeto = $placeto;

        return $this;
    }

    /**
     * Get placeto
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPlaceto() {
        return $this->placeto;
    }

    public function __toString() {
        $return = '';

        ($this->exclusive) ? $return.= ' Private Transfer' : $return.= ' Shared Transfer ';
        $return.=' For ' . $this->passengers . ' Paxs';

        if ($this->placefrom) {
            $return.= ' From: ' . $this->placefrom;
        }
        if ($this->placeto) {
            $return.= ' To: ' . $this->placeto;
        }
        if ($this->getDate()) {
            $return.= ' In: ' . $this->date->format('M j, Y');
        }
        if ($this->dateroundtrip && $this->roundtrip) {
            $return.= ' & Roudtrip ' . $this->dateroundtrip->format('M j, Y');
        }
        return $return;
    }

    /**
     * Set transfer
     *
     * @param \Daiquiri\AdminBundle\Entity\Transfer $transfer
     *
     * @return TransferSearcher
     */
    public function setTransfer(\Daiquiri\AdminBundle\Entity\Transfer $transfer = null) {
        $this->transfer = $transfer;

        return $this;
    }

    /**
     * Get transfer
     *
     * @return \Daiquiri\AdminBundle\Entity\Transfer
     */
    public function getTransfer() {
        return $this->transfer;
    }

}
