<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaignTransferExclusive
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignTransferColective extends Campaign {

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
     * @ORM\Column(name="pricepxdiscount", type="float", nullable=true)
     */
    private $pricepaxdiscount;

    /**
     * @ORM\ManyToMany(targetEntity="TransferColective", mappedBy="campaigns")
     */
    private $transfers;

    public function getproduct() {
        return $this->transfers;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\TransferColective $transfer
     *
     */
    public function addTransfer(\Daiquiri\AdminBundle\Entity\TransferColective $transfer) {
        $transfer->addCampaign($this);
        $this->transfers[] = $transfer;
        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\TransferColective $transfer
     */
    public function removeTransfer(\Daiquiri\AdminBundle\Entity\TransferColective $transfer) {
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
     * Set price
     *
     * @param float $pricepaxdiscount
     *
     * @return CampaignTransferColective
     */
    public function setPricepaxdiscount($pricepaxdiscount) {
        $this->pricepaxdiscount = $pricepaxdiscount;

        return $this;
    }

    /**
     * Get pricepaxdiscount
     *
     * @return float
     */
    public function getPricepaxdiscount() {
        return $this->pricepaxdiscount;
    }

    public function __construct() {
        $this->transfers = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
