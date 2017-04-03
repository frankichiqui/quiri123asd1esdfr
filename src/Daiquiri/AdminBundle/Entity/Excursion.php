<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Excursion
 *
 * @ORM\Table(name="excursion")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ExcursionRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"excursion"="Excursion","excursion_colective"="ExcursionColective","excursion_exclusive"="ExcursionExclusive"})
 */
class Excursion extends Product {

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
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="include", type="string", length=2000, nullable=true)
     */
    private $include;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="notinclude", type="string", length=2000, nullable=true)
     */
    private $notinclude;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Polo
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Polo", inversedBy="excursions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="polofrom", referencedColumnName="id")
     * })
     */
    private $polofrom;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\ExcursionType", inversedBy="excursions")
     * @ORM\JoinTable(name="excursion_excursion_types")
     */
    private $excursionTypes;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Place", inversedBy="excursions")
     * @ORM\JoinTable(name="excursion_place")
     */
    private $places;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sunday", type="boolean", nullable=true)
     */
    private $sunday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="monday", type="boolean", nullable=true)
     */
    private $monday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="thuesday", type="boolean", nullable=true)
     */
    private $thuesday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="wednesday", type="boolean", nullable=true)
     */
    private $wednesday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="thursday", type="boolean", nullable=true)
     */
    private $thursday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="friday", type="boolean", nullable=true)
     */
    private $friday;

    /**
     * @var boolean
     *
     * @ORM\Column(name="saturday", type="boolean", nullable=true)
     */
    private $saturday;

    /**
     * @var float
     *
     * @ORM\Column(name="adultprice", type="float", nullable=true)
     */
    private $adultprice;

    /**
     * @var float
     *
     * @ORM\Column(name="kid_price", type="float", nullable=true)
     */
    private $kidPrice;

    public function getTipo() {
        return 'Excursion ';
    }

    /**
     * Set include
     *
     * @param string $include
     *
     * @return Excursion
     */
    public function setInclude($include) {
        $this->include = $include;

        return $this;
    }

    /**
     * Get include
     *
     * @return string
     */
    public function getInclude() {
        return $this->include;
    }

    /**
     * Set notinclude
     *
     * @param string $notinclude
     *
     * @return Excursion
     */
    public function setNotinclude($notinclude) {
        $this->notinclude = $notinclude;

        return $this;
    }

    /**
     * Get notinclude
     *
     * @return string
     */
    public function getNotinclude() {
        return $this->notinclude;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Excursion
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set sunday
     *
     * @param boolean $sunday
     *
     * @return Excursion
     */
    public function setSunday($sunday) {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday() {
        return $this->sunday;
    }

    /**
     * Set monday
     *
     * @param boolean $monday
     *
     * @return Excursion
     */
    public function setMonday($monday) {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday() {
        return $this->monday;
    }

    /**
     * Set thuesday
     *
     * @param boolean $thuesday
     *
     * @return Excursion
     */
    public function setThuesday($thuesday) {
        $this->thuesday = $thuesday;

        return $this;
    }

    /**
     * Get thuesday
     *
     * @return boolean
     */
    public function getThuesday() {
        return $this->thuesday;
    }

    /**
     * Set wednesday
     *
     * @param boolean $wednesday
     *
     * @return Excursion
     */
    public function setWednesday($wednesday) {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday() {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param boolean $thursday
     *
     * @return Excursion
     */
    public function setThursday($thursday) {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday() {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param boolean $friday
     *
     * @return Excursion
     */
    public function setFriday($friday) {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday() {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param boolean $saturday
     *
     * @return Excursion
     */
    public function setSaturday($saturday) {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday() {
        return $this->saturday;
    }

    public function isDepartureInDate(\DateTime $date) {

        if ($date->format('N') == 1 && $this->monday) {
            return true;
        }
        if ($date->format('N') == 2 && $this->thuesday) {
            return true;
        }
        if ($date->format('N') == 3 && $this->wednesday) {
            return true;
        }
        if ($date->format('N') == 4 && $this->thursday) {
            return true;
        }
        if ($date->format('N') == 5 && $this->friday) {
            return true;
        }
        if ($date->format('N') == 6 && $this->saturday) {
            return true;
        }
        if ($date->format('N') == 7 && $this->sunday) {
            return true;
        }
        return false;
    }

    public function hasTypes($types) {
        if (count($types) > 0) {

            foreach ($types as $t) {
                if (!$this->hasType($t)) {
                    return false;
                }
            }
            return true;
        }
        return true;
    }

    public function hasType(ExcursionType $t) {
        return $this->excursionTypes->contains($t);
    }

    public function allowPassenger($adult, $kid) {
        return true;
    }

    /**
     * Set kidPrice
     *
     * @param float $kidPrice
     *
     * @return Excursion
     */
    public function setKidPrice($kidPrice) {
        $this->kidPrice = $kidPrice;

        return $this;
    }

    /**
     * Get kidPrice
     *
     * @return float
     */
    public function getKidPrice() {
        return $this->kidPrice;
    }

    public function isAvailableinDate($date) {
        $value = $date->format('N');

        switch ($value) {
            case "1": {
                    return $this->monday;
                    break;
                }
            case "2": {
                    return $this->thuesday;
                    break;
                }
            case "3": {
                    return $this->wednesday;
                    break;
                }
            case "4": {
                    return $this->thursday;
                    break;
                }
            case "5": {
                    return $this->friday;
                    break;
                }
            case "6": {
                    return $this->saturday;
                    break;
                }
            case "7": {
                    return $this->sunday;
                    break;
                }
            default : return false;
        }
    }

    /**
     * Set adultprice
     *
     * @param float $adultprice
     *
     * @return Excursion
     */
    public function setAdultprice($adultprice) {
        $this->adultprice = $adultprice;

        return $this;
    }

    /**
     * Get adultprice
     *
     * @return float
     */
    public function getAdultprice() {
        return $this->adultprice;
    }

    public function hasGoogleLocation() {
        
        foreach ($this->places as $p) {
            if (!$p->hasGoogleLocation()) {
                return false;
            }
        }
        return TRUE;
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

    public function getPrice(\Daiquiri\ReservationBundle\Entity\CartItem $item = null, Market $m) {
        $price = $this->adultprice;
        if ($item) {
            return $this->getPriceByAdultAndKidds($item->getStartdate(), $item->getAdult(), $item->getKid(), $m);
        }
        return $price;
    }

    public function getPriceByAdultAndKidds(\DateTime $date, $adults = 0, $kids = 0, Market $m) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        $c = $this->getCampaignForDate($date, $m);
        if ($c) {
            $this->current_offert = $c;
            return ((($this->getKidPrice() - $c->getKiddiscount()) * $kids) + (($this->getAdultprice() - $c->getAdultdiscount()) * $adults)) * ( 1 + $increment);
        }
        return (($this->getKidPrice() * $kids) + ($this->getAdultprice() * $adults)) * ( 1 + $increment);
    }

    /**
     * Set polofrom
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polofrom
     *
     * @return Excursion
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
     * Add excursionType
     *
     * @param \Daiquiri\AdminBundle\Entity\ExcursionType $excursionType
     *
     * @return Excursion
     */
    public function addExcursionType(\Daiquiri\AdminBundle\Entity\ExcursionType $excursionType) {
        $this->excursionTypes[] = $excursionType;

        return $this;
    }

    /**
     * Remove excursionType
     *
     * @param \Daiquiri\AdminBundle\Entity\ExcursionType $excursionType
     */
    public function removeExcursionType(\Daiquiri\AdminBundle\Entity\ExcursionType $excursionType) {
        $this->excursionTypes->removeElement($excursionType);
    }

    /**
     * Get excursionTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExcursionTypes() {
        return $this->excursionTypes;
    }

    public function getColective() {
        
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->excursionTypes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function constaninAllPlaces($places) {
        if (count($places) == 0) {
            return true;
        }
        foreach ($places as $value) {
            if (!$this->places->contains($value)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Add place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     *
     * @return Excursion
     */
    public function addPlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $place
     */
    public function removePlace(\Daiquiri\AdminBundle\Entity\Place $place) {
        $this->places->removeElement($place);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaces() {
        return $this->places;
    }

}
