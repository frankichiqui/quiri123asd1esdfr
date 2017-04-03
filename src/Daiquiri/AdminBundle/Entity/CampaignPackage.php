<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignPackage extends Campaign {

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
     * @ORM\ManyToOne(targetEntity="PackageOption", inversedBy="campaigns")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id", nullable=true)
     */
    private $package;

    public function getproduct() {
        return $this->package;
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
     * Set package
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $package
     *
     * @return CampaignPackage
     */
    public function setPackage(\Daiquiri\AdminBundle\Entity\PackageOption $package = null) {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Daiquiri\AdminBundle\Entity\PackageOption
     */
    public function getPackage() {
        return $this->package;
    }

}
