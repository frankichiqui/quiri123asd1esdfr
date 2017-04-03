<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignCircuit extends Campaign {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="adultdiscount", type="float")
     */
    private $adultdiscount;

    /**
     * @var float
     *
     * @ORM\Column(name="kiddiscount", type="float")
     */
    private $kiddiscount;

    /**
     * @ORM\ManyToOne(targetEntity="Circuit", inversedBy="campaigns")
     * @ORM\JoinColumn(name="circuit_id", referencedColumnName="id", nullable=true)
     */
    private $circuit;

    public function getproduct() {
        return $this->circuit;
    }

    /**
     * Set adultdiscount
     *
     * @param float $adultdiscount
     *
     * @return CampaignCircuit
     */
    public function setAdultdiscount($adultdiscount) {
        $this->adultdiscount = $adultdiscount;

        return $this;
    }

    /**
     * Get adultdiscount
     *
     * @return float
     */
    public function getAdultdiscount() {
        return $this->adultdiscount;
    }

    /**
     * Set kiddiscount
     *
     * @param float $kiddiscount
     *
     * @return CampaignCircuit
     */
    public function setKiddiscount($kiddiscount) {
        $this->kiddiscount = $kiddiscount;

        return $this;
    }

    /**
     * Get kiddiscount
     *
     * @return float
     */
    public function getKiddiscount() {
        return $this->kiddiscount;
    }

    /**
     * Set circuit
     *
     * @param \Daiquiri\AdminBundle\Entity\Circuit $circuit
     *
     * @return CampaignCircuit
     */
    public function setCircuit(\Daiquiri\AdminBundle\Entity\Circuit $circuit = null) {
        $circuit->addCampaign($this);
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

}
