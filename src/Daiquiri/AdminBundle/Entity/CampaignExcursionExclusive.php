<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignExcursionExclusive extends Campaign {

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
     * @ORM\ManyToOne(targetEntity="ExcursionExclusive", inversedBy="campaigns")
     * @ORM\JoinColumn(name="excursion_id", referencedColumnName="id", nullable=true)
     */
    private $excursion;
     public function getproduct() {
        return $this->excursion;
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
     * Set excursion
     *
     * @param \Daiquiri\AdminBundle\Entity\Excursion $excursion
     *
     * @return CampaignExcursion
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

}
