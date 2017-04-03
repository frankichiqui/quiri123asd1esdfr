<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaignTransferExclusive
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignTransferExclusive extends Campaign {

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
     * @ORM\Column(name="price01_02", type="float", nullable=true)
     */
    private $price0102;

    /**
     * @var float
     *
     * @ORM\Column(name="price03_04", type="float", nullable=true)
     */
    private $price0304;

    /**
     * @var float
     *
     * @ORM\Column(name="price05_07", type="float", nullable=true)
     */
    private $price0507;

    /**
     * @var float
     *
     * @ORM\Column(name="price08_12", type="float", nullable=true)
     */
    private $price0812;

    /**
     * @var float
     *
     * @ORM\Column(name="price13_19", type="float", nullable=true)
     */
    private $price1319;

    /**
     * @var float
     *
     * @ORM\Column(name="price20_30", type="float", nullable=true)
     */
    private $price2030;

    /**
     * @var float
     *
     * @ORM\Column(name="price31_40", type="float", nullable=true)
     */
    private $price3140;

    /**
     * @ORM\ManyToMany(targetEntity="TransferExclusive", mappedBy="campaigns")
     */
    private $transfers;

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\TransferExclusive $transfer
     *
     */
    public function addTransfer(\Daiquiri\AdminBundle\Entity\TransferExclusive $transfer) {
        $transfer->addCampaign($this);
        $this->transfers[] = $transfer;
        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\TransferExclusive $transfer
     */
    public function removeTransfer(\Daiquiri\AdminBundle\Entity\TransferExclusive $transfer) {
        $transfer->removeCampaign($this);
        $this->transfers->removeElement($transfer);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransfers() {
        return $this->transfers;
    }

    /**
     * Set price0102
     *
     * @param float $price0102
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice0102($price0102) {
        $this->price0102 = $price0102;

        return $this;
    }

    /**
     * Get price0102
     *
     * @return float
     */
    public function getPrice0102() {
        return $this->price0102;
    }

    /**
     * Set price0304
     *
     * @param float $price0304
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice0304($price0304) {
        $this->price0304 = $price0304;

        return $this;
    }

    /**
     * Get price0304
     *
     * @return float
     */
    public function getPrice0304() {
        return $this->price0304;
    }

    /**
     * Set price0507
     *
     * @param float $price0507
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice0507($price0507) {
        $this->price0507 = $price0507;

        return $this;
    }

    /**
     * Get price0507
     *
     * @return float
     */
    public function getPrice0507() {
        return $this->price0507;
    }

    /**
     * Set price0812
     *
     * @param float $price0812
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice0812($price0812) {
        $this->price0812 = $price0812;

        return $this;
    }

    /**
     * Get price0812
     *
     * @return float
     */
    public function getPrice0812() {
        return $this->price0812;
    }

    /**
     * Set price1319
     *
     * @param float $price1319
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice1319($price1319) {
        $this->price1319 = $price1319;

        return $this;
    }

    /**
     * Get price1319
     *
     * @return float
     */
    public function getPrice1319() {
        return $this->price1319;
    }

    /**
     * Set price2030
     *
     * @param float $price2030
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice2030($price2030) {
        $this->price2030 = $price2030;

        return $this;
    }

    /**
     * Get price2030
     *
     * @return float
     */
    public function getPrice2030() {
        return $this->price2030;
    }

    /**
     * Set price3140
     *
     * @param float $price3140
     *
     * @return CampaignTransferExclusive
     */
    public function setPrice3140($price3140) {
        $this->price3140 = $price3140;

        return $this;
    }

    /**
     * Get price3140
     *
     * @return float
     */
    public function getPrice3140() {
        return $this->price3140;
    }

    public function __construct() {
        $this->transfers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getproduct() {
        return $this->transfers;
    }

}
