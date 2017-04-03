<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransferColective
 *
 * @ORM\Table(name="transfer_colective")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\TransferColectiveRepository")
 */
class TransferColective extends Transfer {

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
     * @ORM\Column(name="pricepax", type="float", nullable=true)
     */
    private $pricepax;

    /**
     *  @ORM\ManyToMany(targetEntity="CampaignTransferColective", inversedBy="transfers")
     *  @ORM\JoinTable(name="campaigntransfercolective_transfers")
     */
    private $campaigns;

    /**
     * Set price
     *
     * @param float $pricepax
     *
     * @return TransferColective
     */
    public function setPricepax($pricepax) {
        $this->pricepax = $pricepax;

        return $this;
    }

    /**
     * Get pricepax
     *
     * @return float
     */
    public function getPricepax() {
        return $this->pricepax;
    }

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->getCampaigns() as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                return $c;
            }
        }
        return null;
    }

    public $current_offert;

    public function getTransferPrice($paxs = null, \DateTime $date, Market $market) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        if (!$paxs) {
            return 0;
        }
        $c = $this->getCampaignForDate($date, $market);
        if ($c) {
            $this->current_offert = $c;
            return $paxs * ($this->pricepax - $c->getPricepaxdiscount()) * (1 + $increment);
        }
        $this->current_offert = null;
        return $paxs * $this->pricepax * (1 + $increment);
    }

    public function getPrice(\Daiquiri\ReservationBundle\Entity\TransferColectiveItem $item = null, Market $market) {
        $price = $this->getTransferPrice($item->getPassengers(), $item->getStartdate(), $market);
        return $price;
    }

    public function getColective() {
        return true;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignTransferColective $campaign
     *
     * @return TransferColective
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignTransferColective $campaign) {
        $this->campaigns[] = $campaign;
        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignTransferColective $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignTransferColective $campaign) {
        $this->campaigns->removeElement($campaign);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampaigns() {
        return $this->campaigns;
    }

    public function setCampaings($campaigns) {
        if (count($campaigns) > 0) {
            foreach ($campaigns as $c) {
                if (!$this->campaigns->contains($c)) {
                    $this->addCampaign($c);
                }
            }
        }
        return $this;
    }

    public function getFromprice() {

        return $this->pricepax;
    }

}
