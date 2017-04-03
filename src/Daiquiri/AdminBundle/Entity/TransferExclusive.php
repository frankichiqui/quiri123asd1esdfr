<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransferExclusive
 *
 * @ORM\Table(name="transfer_exclusive")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\TransferExclusiveRepository")
 */
class TransferExclusive extends Transfer {

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
     *  @ORM\ManyToMany(targetEntity="CampaignTransferExclusive", inversedBy="transfers")
     *  @ORM\JoinTable(name="campaigntransferexclisive_transfers")
     */
    private $campaigns;

    /**
     * Set price0102
     *
     * @param float $price0102
     *
     * @return TransferExclusive
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
     * @return TransferExclusive
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
     * @return TransferExclusive
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
     * @return TransferExclusive
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
     * @return TransferExclusive
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
     * @return TransferExclusive
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
     * @return TransferExclusive
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

    public function getTransferPrice($paxs = null, \DateTime $date, Market $market) {
        $c = $this->getCampaignForDate($date, $market);

        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        if ($paxs > 0 && $paxs <= 2) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price0102 - $c->getPrice0102()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price0102 * (1 + $increment);
        }
        if ($paxs > 2 && $paxs <= 4) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price0304 - $c->getPrice0304()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price0304 * (1 + $increment);
        }
        if ($paxs > 4 && $paxs <= 7) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price0507 - $c->getPrice0507()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price0507 * (1 + $increment);
        }
        if ($paxs > 7 && $paxs <= 12) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price0812 - $c->getPrice0812()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price0812 * (1 + $increment);
        }
        if ($paxs > 12 && $paxs <= 19) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price1319 - $c->getPrice1319()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price1319 * (1 + $increment);
        }
        if ($paxs > 19 && $paxs <= 30) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price2030 - $c->getPrice2030()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price2030 * (1 + $increment);
        }
        if ($paxs > 30 && $paxs <= 40) {
            if ($c) {
                $this->current_offert = $c;
                return ($this->price3140 - $c->getPrice3140()) * (1 + $increment);
            }
            $this->current_offert = null;
            return $this->price3140 * (1 + $increment);
        }
        return -1;
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

    public function getPrice(\Daiquiri\ReservationBundle\Entity\TransferExclusiveItem $item = null, Market $market) {
        $price = $this->getTransferPrice($item->getPassengers(), $item->getStartdate(), $market);

        return $price;
    }

    public function getColective() {
        return false;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignTransferExclusive $campaign
     *
     * @return TransferExclusive
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignTransferExclusive $campaign) {
        $this->campaigns[] = $campaign;
        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignTransferExclusive $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignTransferExclusive $campaign) {
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
        return min(array($this->price0102, $this->price0304, $this->price0507, $this->price0812, $this->price1319, $this->price2030, $this->price3140));
    }

}
