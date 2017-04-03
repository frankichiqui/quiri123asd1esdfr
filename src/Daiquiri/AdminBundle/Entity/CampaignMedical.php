<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignMedical extends Campaign {

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
     * @ORM\ManyToOne(targetEntity="MedicalService", inversedBy="campaigns")
     * @ORM\JoinColumn(name="medical_id", referencedColumnName="id", nullable=true)
     */
    private $medical;

    public function getproduct() {
        return $this->medical;
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
     * Set medical
     *
     * @param \Daiquiri\AdminBundle\Entity\MedicalService $medical
     *
     * @return CampaignMedical
     */
    public function setMedical(\Daiquiri\AdminBundle\Entity\MedicalService $medical = null) {
        $this->medical = $medical;
        return $this;
    }

    /**
     * Get medical
     *
     * @return \Daiquiri\AdminBundle\Entity\MedicalService
     */
    public function getMedical() {
        return $this->medical;
    }

}
