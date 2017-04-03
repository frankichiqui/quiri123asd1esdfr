<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotelPrice
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class HotelPrice {

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
     * @ORM\Column(name="base", type="float")
     */
    private $base;

    /**
     * @var float
     *
     * @ORM\Column(name="individual", type="float")
     */
    private $individual;

    /**
     * @var integer
     *
     * @ORM\Column(name="CHindividual", type="integer")
     */
    private $cHindividual;

    /**
     * @var float
     *
     * @ORM\Column(name="three", type="float")
     */
    private $three;

    /**
     * @var float
     *
     * @ORM\Column(name="adult1", type="float",options={"default"=0})
     */
    private $adult1;

    /**
     * @var float
     *
     * @ORM\Column(name="adult2", type="float",options={"default"=0})
     */
    private $adult2;

    /**
     * @var float
     *
     * @ORM\Column(name="adult3", type="float",options={"default"=0})
     */
    private $adult3;

    /**
     * @var integer
     *
     * @ORM\Column(name="CHthree", type="integer")
     */
    private $cHthree;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Season
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Season", inversedBy="season_hotel_price", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="season", referencedColumnName="id")
     * })
     */
    private $season;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Room
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Room", inversedBy="room_hotel_price",cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room", referencedColumnName="id")
     * })
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\KidPolicy", mappedBy="hotelprice", cascade={"all"}, orphanRemoval=true)
     */
    private $kidpolicys;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set base
     *
     * @param float $base
     *
     * @return HotelPrice
     */
    public function setBase($base) {
        $this->base = $base;

        return $this;
    }

    /**
     * Get base
     *
     * @return float
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Set individual
     *
     * @param float $individual
     *
     * @return HotelPrice
     */
    public function setIndividual($individual) {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return float
     */
    public function getIndividual() {
        return $this->individual;
    }

    /**
     * Set cHindividual
     *
     * @param integer $cHindividual
     *
     * @return HotelPrice
     */
    public function setCHindividual($cHindividual) {
        $this->cHindividual = $cHindividual;

        return $this;
    }

    /**
     * Get cHindividual
     *
     * @return integer
     */
    public function getCHindividual() {
        return $this->cHindividual;
    }

    /**
     * Set three
     *
     * @param float $three
     *
     * @return HotelPrice
     */
    public function setThree($three) {
        $this->three = $three;

        return $this;
    }

    /**
     * Get three
     *
     * @return float
     */
    public function getThree() {
        return $this->three;
    }

    /**
     * Set cHthree
     *
     * @param integer $cHthree
     *
     * @return HotelPrice
     */
    public function setCHthree($cHthree) {
        $this->cHthree = $cHthree;

        return $this;
    }

    /**
     * Get cHthree
     *
     * @return integer
     */
    public function getCHthree() {
        return $this->cHthree;
    }

    /**
     * Set season
     *
     * @param \Daiquiri\AdminBundle\Entity\Season $season
     *
     * @return HotelPrice
     */
    public function setSeason(\Daiquiri\AdminBundle\Entity\Season $season = null) {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return \Daiquiri\AdminBundle\Entity\Season
     */
    public function getSeason() {
        return $this->season;
    }

    /**
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return HotelPrice
     */
    public function setRoom(\Daiquiri\AdminBundle\Entity\Room $room = null) {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Daiquiri\AdminBundle\Entity\Room
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->kidpolicys = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     *
     * @return HotelPrice
     */
    public function addKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $this->kidpolicys[] = $kidpolicy;
        $kidpolicy->setHotelprice($this);
        return $this;
    }

    /**
     * Remove kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     */
    public function removeKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $this->kidpolicys->removeElement($kidpolicy);
        $kidpolicy->setHotelprice(null);
    }

    public function setKidpolicys($kidpolicys) {
        if (count($kidpolicys) > 0) {
            foreach ($kidpolicys as $i) {
                if (!$this->kidpolicys->contains($i)) {
                    $this->addKidpolicy($i);
                }
            }
        }
        return $this;
    }

    /**
     * Get kidpolicys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKidpolicys() {
        return $this->kidpolicys;
    }

    public function sortKidPolicysByAdultAndKid() {
        for ($i = 0; $i < $this->kidpolicys->count(); $i++) {
            for ($j = 0; $j < $this->kidpolicys->count(); $j++) {
                if ($this->kidpolicys->get($i)->getOcupation()->getAdults() < $this->kidpolicys->get($j)->getOcupation()->getAdults()) {
                    $aux = $this->kidpolicys->get($i);
                    $this->kidpolicys->set($i, $this->kidpolicys->get($j));
                    $this->kidpolicys->set($j, $aux);
                } else if ($this->kidpolicys->get($i)->getOcupation()->getAdults() == $this->kidpolicys->get($j)->getOcupation()->getAdults()) {
                    if ($this->kidpolicys->get($i)->getOcupation()->getKids() < $this->kidpolicys->get($j)->getOcupation()->getKids()) {
                        $aux = $this->kidpolicys->get($i);
                        $this->kidpolicys->set($i, $this->kidpolicys->get($j));
                        $this->kidpolicys->set($j, $aux);
                    }
                }
            }
        }
        return $this;
    }

    public function UpdateAllPrice() {
        $this->adult1 = $this->base + $this->getValuePlusIndividualUse();
        $this->adult2 = $this->base * 2;
        $this->adult3 = $this->base * 2 + $this->getValueThreePax();
        foreach ($this->kidpolicys as $k) {
            $k->UpdateAllPrice();
        }
    }

    public function getAdultPrice(Ocupation $o) {
        switch ($o->getAdults()) {
            case 0: {
                    return 0;
                    break;
                }
            case 1: {
                    if ($o->getKids() == 0) {
                        return $this->base + $this->getValuePlusIndividualUse();
                    }
                    return $this->base;
                    break;
                }
            case 2: {
                    return $this->base * 2;
                    break;
                }
            case 3: {
                    return $this->base * 2 + $this->getValueThreePax();
                    break;
                }
            default : {
                    return $this->base * 2;
                    break;
                }
        }
    }

    private function getKidPrice(Ocupation $o) {
        $value = 0;
        foreach ($this->kidpolicys as $k) {
            if ($k->getOcupation()->getId() == $o->getId()) {
                $value = $k->getTotalKidValue();
            }
        }
        return $value;
    }

    public function getPrice(Ocupation $o) {
        
        
        if ($o->hasOnlyAdults()) {
            return $this->getAdultPrice($o);
        } else {
            return $this->getAdultPrice($o) + $this->getKidPrice($o);
        }
    }

    private function getValueThreePax() {
        if ($this->cHthree == 1) {
            return ((1 - ($this->three / 100)) * $this->base);
        } else {
            return $this->base - $this->three;
        }
    }

    private function getValuePlusIndividualUse() {
        if ($this->cHindividual == 1) {
            return ($this->base) * ($this->individual / 100);
        } else {
            return $this->individual;
        }
    }

    /**
     * Set adult1
     *
     * @param float $adult1
     *
     * @return HotelPrice
     */
    public function setAdult1($adult1) {
        $this->adult1 = $adult1;

        return $this;
    }

    /**
     * Get adult1
     *
     * @return float
     */
    public function getAdult1() {
        return $this->adult1;
    }

    /**
     * Set adult2
     *
     * @param float $adult2
     *
     * @return HotelPrice
     */
    public function setAdult2($adult2) {
        $this->adult2 = $adult2;

        return $this;
    }

    /**
     * Get adult2
     *
     * @return float
     */
    public function getAdult2() {
        return $this->adult2;
    }

    /**
     * Set adult3
     *
     * @param float $adult3
     *
     * @return HotelPrice
     */
    public function setAdult3($adult3) {
        $this->adult3 = $adult3;

        return $this;
    }

    /**
     * Get adult3
     *
     * @return float
     */
    public function getAdult3() {
        return $this->adult3;
    }

}
