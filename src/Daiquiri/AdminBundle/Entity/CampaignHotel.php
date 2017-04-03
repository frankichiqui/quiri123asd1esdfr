<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignHotel extends Campaign {

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
     * @ORM\Column(name="base", type="float", options={"default"=0})
     */
    private $base;

    /**
     * @var float
     *
     * @ORM\Column(name="individual", type="float", options={"default"=0})
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
     * @ORM\Column(name="three", type="float", options={"default"=0})
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
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="campaigns")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=true)
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="KidPolicy", mappedBy="campaign",cascade={"all"})
     */
    private $kidpolicys;

    public function getproduct() {
        return $this->room;
    }

    /**
     * Set base
     *
     * @param float $base
     *
     * @return CampaignHotel
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
    public function __construct() {
        $this->kidpolicys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adult1 = 0;
        $this->adult2 = 0;
        $this->adult3 = 0;
        $this->base = 0;
        $this->individual = 0;
        $this->cHindividual = 1;
        $this->cHthree = 1;
        $this->three = 0;
    }

    public function getBase() {
        return $this->base;
    }

    /**
     * Set individual
     *
     * @param float $individual
     *
     * @return CampaignHotel
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
     * @return CampaignHotel
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
     * @return CampaignHotel
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
     * Set adult1
     *
     * @param float $adult1
     *
     * @return CampaignHotel
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
     * @return CampaignHotel
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
     * @return CampaignHotel
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

    /**
     * Set cHthree
     *
     * @param integer $cHthree
     *
     * @return CampaignHotel
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
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return CampaignHotel
     */
    public function setRoom(\Daiquiri\AdminBundle\Entity\Room $room = null) {
        $room->addCampaign($this);
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

    public function deleteAllkidPolityc() {
        $this->kidpolicys->clear();
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

    /**
     * Add kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     *
     * @return CampaignHotel
     */
    public function addKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $kidpolicy->setCampaign($this);
        $this->kidpolicys[] = $kidpolicy;

        return $this;
    }

    /**
     * Remove kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     */
    public function removeKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $kidpolicy->setCampaign();
        $this->kidpolicys->removeElement($kidpolicy);
    }

    /**
     * Get kidpolicys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKidpolicys() {
        return $this->kidpolicys;
    }

    public function setPriceDataPriceToHotelPrice(HotelPrice $hp) {
        $this->base = $hp->getBase();
        $this->individual = $hp->getIndividual();
        $this->three = $hp->getThree();
        $this->cHindividual = $hp->getCHindividual();
        $this->cHthree = $hp->getCHthree();
        $this->kidpolicys = $hp->getKidpolicys();
        $this->adult1 = $hp->getAdult1();
        $this->adult2 = $hp->getAdult2();
        $this->adult3 = $hp->getAdult3();
        $this->room = $hp->getRoom();
        return $this;
    }

    public function hasPrice() {
        if ($this->kidpolicys->count() > 0 && $this->base > 0 && $this->individual > 0 && $this->three > 0) {
            return true;
        }
        return false;
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

}
