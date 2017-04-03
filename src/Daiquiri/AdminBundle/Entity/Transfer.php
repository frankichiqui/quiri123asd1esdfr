<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transfer
 *
 * @ORM\Table(name="transfer", indexes={@ORM\Index(name="IDX_4034A3C0FBC3DE7B", columns={"placefrom"}), @ORM\Index(name="IDX_4034A3C05BB10F94", columns={"placeto"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\TransferRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"transfer"="Transfer","transfer_colective"="TransferColective","transfer_exclusive"="TransferExclusive"})
 */
class Transfer extends Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Place
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", inversedBy="transfers_from", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="placefrom", referencedColumnName="id")
     * })
     */
    private $placefrom;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Place
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", inversedBy="transfers_to", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="placeto", referencedColumnName="id")
     * })
     */
    private $placeto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reverse", type="boolean", nullable=true)
     */
    private $reverse;

    /**
     * @var integer
     *
     * @ORM\Column(name="stop", type="integer", nullable=true, options={"default"=0})
     */
    private $stop;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endtime", type="date", nullable=true)
     */
    private $endtime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starttime", type="date", nullable=true)
     */
    private $starttime;

    /**
     * Set placefrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $placefrom
     *
     * @return Transfer
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
     * @return Transfer
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

    /**
     * Set reverse
     *
     * @param boolean $reverse
     *
     * @return Transfer
     */
    public function setReverse($reverse) {
        $this->reverse = $reverse;

        return $this;
    }

    /**
     * Get reverse
     *
     * @return boolean
     */
    public function getReverse() {
        return $this->reverse;
    }

    public function getTypeTransfer() {
        if ($this->placefrom->containType('airport')) {
            return 1;
        }
        if ($this->placeto->containType('airport')) {
            return 2;
        }
        return 3;
    }

    public function getReverseTransfer() {
        $reverse = $this;
        $aux_place = $reverse->getPlacefrom();
        $reverse->setPlacefrom($reverse->getPlaceto());
        $reverse->setPlaceto($aux_place);
        $reverse->setTitle($this->getPlaceto()->getTitle() . " a " . $this->getPlacefrom()->getTitle());
        return $reverse;
    }

    public function __toString() {
        return $this->placefrom . " - " . $this->placeto;
    }

    public function getColective() {
        return null;
    }

    /**
     * Set stop
     *
     * @param integer $stop
     *
     * @return Transfer
     */
    public function setStop($stop) {
        $this->stop = $stop;

        return $this;
    }

    /**
     * Get stop
     *
     * @return integer
     */
    public function getStop() {
        return $this->stop;
    }


    /**
     * Set endtime
     *
     * @param \DateTime $endtime
     *
     * @return Transfer
     */
    public function setEndtime($endtime) {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return \DateTime
     */
    public function getEndtime() {
        return $this->endtime;
    }

    /**
     * Set starttime
     *
     * @param \DateTime $starttime
     *
     * @return Transfer
     */
    public function setStarttime($starttime) {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return \DateTime
     */
    public function getStarttime() {
        return $this->starttime;
    }

    public function getFullTime() {
        $datetime1 = $this->getEndtime()->format('H:i:s');
        $datetime2 = $this->getStarttime()->format('H:i:s');
        $hourdiff = round((strtotime($datetime1) - strtotime($datetime2))/3600, 1);
        return $hourdiff;
    }

}
