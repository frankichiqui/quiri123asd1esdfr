<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CircuitRepository")
 */
class Circuit extends Product {

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
     * @ORM\Column(name="days", type="integer", nullable=true)
     */
    private $days;

    /**
     * @var integer
     *
     * @ORM\Column(name="nights", type="integer", nullable=true)
     */
    private $nights;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\CircuitAvailability", inversedBy="circuits", cascade={"all"},)
     * @ORM\JoinTable(name="circuit_circuitavailabilitys")
     */
    private $circuit_availabilitys;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\CircuitDay", mappedBy="circuit", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    private $circuit_days;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\CircuitSeason", mappedBy="circuit", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    private $circuit_seasons;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo", inversedBy="circuits")
     * @ORM\JoinColumn(name="polofromid", referencedColumnName="id")
     */
    private $polofrom;

    /**
     * @ORM\OneToMany(targetEntity="CampaignCircuit", mappedBy="circuit")
     */
    private $campaigns;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_kid", type="boolean",options={"default"=false})
     */
    private $allowkid;

    /**
     * Set circuitDays
     *
     * @param \Doctrine\Common\Collections\Collection $circuitDays
     */
    public function setCircuitDays(\Doctrine\Common\Collections\Collection $circuitDays = null) {
        $new = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($circuitDays as $c) {
            $this->addCircuitDay($c);
            $new->add($c);
        }
        $this->circuit_days = $new;
        return $this;
    }

    /**
     * Add circuitDay
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay
     *
     * @return Circuit
     */
    public function addCircuitDay(\Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay) {
        $circuitDay->setCircuit($this);
        $this->circuit_days->add($circuitDay);
        return $this->sortCircuitsDays();
    }

    public function sortCircuitsDays() {

//        for ($i = 0; $i < $this->circuit_days->count(); $i++) {
//            for ($j = 0; $j < $this->circuit_days->count(); $j++) {
//
//                if ($this->circuit_days->get($i)->getDay() > $this->circuit_days->get($j)->getDay()) {
//                    $aux = $this->circuit_days->get($j);
//                    $this->circuit_days->set($j, $this->circuit_days->get($i));
//                    $this->circuit_days->set($i, $aux);
//                }
//            }
//        }
//        return $this;
    }

    /**
     * Remove circuitDay
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay
     */
    public function removeCircuitDay(\Daiquiri\AdminBundle\Entity\CircuitDay $circuitDay) {
        $circuitDay->setCircuit(null);
        $this->circuit_days->removeElement($circuitDay);
        $this->sortCircuitsDays();
    }

    /**
     * Get circuitDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuitDays() {
        return $this->circuit_days;
    }

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return Circuit
     */
    public function setDays($days) {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays() {
        return $this->days;
    }

    /**
     * Add circuitAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitAvailability $circuitAvailability
     *
     * @return Circuit
     */
    public function addCircuitAvailability(\Daiquiri\AdminBundle\Entity\CircuitAvailability $circuitAvailability) {
        $circuitAvailability->addCircuit($this);
        $this->circuit_availabilitys[] = $circuitAvailability;

        return $this;
    }

    /**
     * Remove circuitAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitAvailability $circuitAvailability
     */
    public function removeCircuitAvailability(\Daiquiri\AdminBundle\Entity\CircuitAvailability $circuitAvailability) {
        $circuitAvailability->removeCircuit($this);
        $this->circuit_availabilitys->removeElement($circuitAvailability);
    }

    /**
     * Get circuitAvailabilitys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuitAvailabilitys() {
        return $this->circuit_availabilitys;
    }

    public function __construct() {
        parent::__construct();
        $this->circuit_availabilitys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->circuit_days = new \Doctrine\Common\Collections\ArrayCollection();
        $this->circuit_seasons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add circuitSeason
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitSeason $circuitSeason
     *
     * @return Circuit
     */
    public function addCircuitSeason(\Daiquiri\AdminBundle\Entity\CircuitSeason $circuitSeason) {
        $circuitSeason->setCircuit($this);
        $this->circuit_seasons->add($circuitSeason);
        return $this;
    }

    /**
     * Remove circuitSeason
     *
     * @param \Daiquiri\AdminBundle\Entity\CircuitSeason $circuitSeason
     */
    public function removeCircuitSeason(\Daiquiri\AdminBundle\Entity\CircuitSeason $circuitSeason) {
        $circuitSeason->setCircuit(null);
        $this->circuit_seasons->removeElement($circuitSeason);
    }

    public function setCircuitSeasons(\Doctrine\Common\Collections\Collection $circuitSeason) {
        $new = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($circuitSeason as $c) {
            $this->addCircuitSeason($c);
            $new->add($c);
        }
        $this->circuit_seasons = $new;
        return $this;
    }

    /**
     * Get circuitSeasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCircuitSeasons() {
        return $this->circuit_seasons;
    }

    public function constainPlace(Place $place) {
        if (count($this->circuit_days) > 0) {
            foreach ($this->circuit_days as $cd) {
                if ($cd->constainPlace($place)) {
                    return true;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->campaigns as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                return $c;
            }
        }
        return null;
    }

    public $current_offert;

    public function getTotalPrice(\DateTime $date, $adults, $kids, Market $market, $ocupation = 1) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        $c = $this->getCampaignForDate($date, $market);
        if (count($this->circuit_seasons) > 0) {
            foreach ($this->circuit_seasons as $s) {
                if ($s->constainDate($date)) {
                    if ($c) {
                        
                        $this->current_offert = $c;
                        if ($ocupation == 1) {
                            //dump($c->getAdultdiscount());die;
                            return (($adults * ($s->getAdultPrice() - $c->getAdultdiscount())) + ($kids * ($s->getKidPrice() - $c->getKiddiscount()))) * (1 + $increment);
                        } else {
                            return (($adults * ($s->getAdultPriceDoble() - $c->getAdultdiscount())) + ($kids * ($s->getKidPriceDoble() - $c->getKiddiscount()))) * (1 + $increment);
                        }
                    }
                    if ($ocupation == 1) {
                        return (($adults * $s->getAdultPrice()) + ($kids * $s->getKidPrice())) * (1 + $increment);
                    } else {
                        return (($adults * $s->getAdultPriceDoble()) + ($kids * $s->getKidPriceDoble())) * (1 + $increment);
                    }
                    break;
                }
            }
        }
        return null;
    }

    public function getCurrentPrice() {
        if (count($this->circuit_seasons) > 0) {
            foreach ($this->circuit_seasons as $s) {
                if ($s->constainDate(new \DateTime('now'))) {
                    return ($s->getAdultPrice());
                }
            }
        }
        return null;
    }

    public function getPrice(\Daiquiri\ReservationBundle\Entity\CircuitItem $item, Market $m) {
        $price = $this->getTotalPrice($item->getStartdate(), $item->getAdults(), $item->getKids(), $m, $item->getOcupation());
        return $price;
    }

    public function isDepartureDate(\DateTime $date) {

        if (!$date || !Validate::isMoreThanMinDate($date)) {
            return false;
        }
        foreach ($this->circuit_availabilitys as $ca) {
            if ($ca->getDate()->format('M j, Y') == $date->format('M j, Y')) {
                return true;
            }
        }
        return false;
    }

    public function constainPlaces($places) {

        if ($places->count() == 0) {
            return false;
        }
        foreach ($places as $p) {
            if (!$this->constainPlace($p)) {
                return false;
            }
        }
        return true;
    }

    public function containPlace($place = null) {
        if (!$place || $this->circuit_days->count() == 0) {
            return false;
        }
        foreach ($this->circuit_days as $d) {
            if ($d->constainPlace($place)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set nights
     *
     * @param integer $nights
     *
     * @return Circuit
     */
    public function setNights($nights) {
        $this->nights = $nights;

        return $this;
    }

    /**
     * Get nights
     *
     * @return integer
     */
    public function getNights() {
        return $this->nights;
    }

    public function isDepartureInDateRange(\DateTime $startdate, \DateTime $enddate) {
        if ($startdate && $enddate) {
            if (Validate::startAndEndDate($startdate, $enddate)) {
                foreach ($this->circuit_availabilitys as $ca) {
                    if (Validate::inRangeDate($ca->getDate(), $startdate, $enddate)) {
                        return TRUE;
                    }
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function constainPolofrom($polo) {
        return $this->polofrom->getTitle() == $polo;
    }

    public function deleteDateDeparture($date) {
        foreach ($this->circuit_availabilitys as $ca) {
            if ($ca->getDate()->format('M j Y') == $date->format(' M j Y')) {
                $this->removeCircuitAvailability($ca);
            }
        }
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignCircuit $campaign
     *
     * @return Circuit
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignCircuit $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignCircuit $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignCircuit $campaign) {
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
        $price = 70000000;
        foreach ($this->circuit_seasons as $s) {
            if ($price > $s->getAdultPrice()) {
                $price = $s->getAdultPrice();
            }
        }
        return $price;
    }

    public function hasGoogleLocation() {
        foreach ($this->circuit_days as $d) {
            foreach ($d->getPlaces() as $p) {
                if (!$p->hasGoogleLocation()) {
                    return false;
                }
            }
        }
        return TRUE;
    }

    /**
     * Set polofrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polofrom
     *
     * @return Circuit
     */
    public function setPolofrom(\Daiquiri\AdminBundle\Entity\Polo $polofrom = null) {
        $this->polofrom = $polofrom;

        return $this;
    }

    /**
     * Get polofrom
     *
     * @return \Daiquiri\AdminBundle\Entity\Polo
     */
    public function getPolofrom() {
        return $this->polofrom;
    }

    /**
     * Set allowkid
     *
     * @param boolean $allowkid
     *
     * @return CircuitSeason
     */
    public function setAllowkid($allowkid) {
        $this->allowkid = $allowkid;

        return $this;
    }

    /**
     * Get allowkid
     *
     * @return 
     * 
     * \booblean
     */
    public function getAllowkid() {
        return $this->allowkid;
    }

}
