<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExcursionColective
 *
 * @ORM\Table(name="excursion_colective")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ExcursionColectiveRepository")
 */
class ExcursionColective extends Excursion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="minpax", type="integer", nullable=true)
     */
    private $minpax;

    /**
     * @ORM\OneToMany(targetEntity="CampaignExcursionColective", mappedBy="excursion")
     */
    private $campaigns;

    /**
     * Set minpax
     *
     * @param integer $minpax
     *
     * @return ExcursionColective
     */
    public function setMinpax($minpax) {
        $this->minpax = $minpax;

        return $this;
    }

    /**
     * Get minpax
     *
     * @return integer
     */
    public function getMinpax() {
        return $this->minpax;
    }

    public function allowPassenger($adult, $kid) {
        if (($adult + $kid) >= $this->minpax) {
            return true;
        }
        return false;
    }

    public function getTipo() {
        return parent::getTipo() .
                ' Colective ';
    }

    public function getColective() {
        return true;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignExcursionColective $campaign
     *
     * @return Excursion
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignExcursionColective $campaign) {
        $campaign->setExcursion($this);
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignExcursionColective $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignExcursionColective $campaign) {
        $campaign->setExcursion();
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
