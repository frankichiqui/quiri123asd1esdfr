<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExcursionExclusive
 *
 * @ORM\Table(name="excursion_exclusive")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ExcursionExclusiveRepository")
 */
class ExcursionExclusive extends Excursion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="CampaignExcursionExclusive", mappedBy="excursion")
     */
    private $campaigns;

    public function getTipo() {
        return parent::getTipo() .
                ' Exclusive ';
    }

    public function getColective() {
        return false;
    }

    public function __construct() {
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignExcursionExclusive $campaign
     *
     * @return ExcursionExclusive
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignExcursionExclusive $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignExcursionExclusive $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignExcursionExclusive $campaign) {
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
    
    public function getFromprice() {       
        return $this->getPrice();
    }

}
