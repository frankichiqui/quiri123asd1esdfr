<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KidPolicy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class KidPolicy {

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
     * @ORM\Column(name="kid1", type="float")
     */
    private $kid1;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid1_choice", type="integer")
     */
    private $kid1_choice;

    /**
     * @var float
     *
     * @ORM\Column(name="kid2", type="float")
     */
    private $kid2;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid2_choice", type="integer")
     */
    private $kid2_choice;

    /**
     * @var float
     *
     * @ORM\Column(name="kid3", type="float")
     */
    private $kid3;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid3_choice", type="integer")
     */
    private $kid3_choice;

    /**
     * @var float
     *
     * @ORM\Column(name="kid4", type="float")
     */
    private $kid4;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid4_choice", type="integer")
     */
    private $kid4_choice;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", options={"default"=0})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\HotelPrice", inversedBy="kidpolicys")
     * @ORM\JoinColumn(name="hotelprice_id", referencedColumnName="id")
     */
    private $hotelprice;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Ocupation", inversedBy="kidpolicy")
     * @ORM\JoinColumn(name="ocupation_id", referencedColumnName="id")
     */
    private $ocupation;

    /**
     * @ORM\ManyToOne(targetEntity="CampaignHotel", inversedBy="kidpolicys")
     * @ORM\JoinColumn(name="campaignhotel_id", referencedColumnName="id")
     */
    private $campaign;

    public function UpdateAllPrice() {
        $this->price = $this->hotelprice->getAdultPrice($this->ocupation) + $this->getTotalKidValue();
    }

    public function __construct() {
        $this->kid1 = 0;
        $this->kid2 = 0;
        $this->kid3 = 0;
        $this->kid4 = 0;

        $this->kid1_choice = 0;
        $this->kid2_choice = 0;
        $this->kid3_choice = 0;
        $this->kid4_choice = 0;

        $this->price = 0;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set kid1
     *
     * @param float $kid1
     *
     * @return KidPolicy
     */
    public function setKid1($kid1) {
        $this->kid1 = $kid1;

        return $this;
    }

    /**
     * Get kid1
     *
     * @return float
     */
    public function getKid1() {
        return $this->kid1;
    }

    /**
     * Set kid2
     *
     * @param float $kid2
     *
     * @return KidPolicy
     */
    public function setKid2($kid2) {
        $this->kid2 = $kid2;

        return $this;
    }

    /**
     * Get kid2
     *
     * @return float
     */
    public function getKid2() {
        return $this->kid2;
    }

    /**
     * Set kid3
     *
     * @param float $kid3
     *
     * @return KidPolicy
     */
    public function setKid3($kid3) {
        $this->kid3 = $kid3;

        return $this;
    }

    /**
     * Get kid3
     *
     * @return float
     */
    public function getKid3() {
        return $this->kid3;
    }

    /**
     * Set kid4
     *
     * @param float $kid4
     *
     * @return KidPolicy
     */
    public function setKid4($kid4) {
        $this->kid4 = $kid4;

        return $this;
    }

    /**
     * Get kid4
     *
     * @return float
     */
    public function getKid4() {
        return $this->kid4;
    }

    /**
     * Set kid1Choice
     *
     * @param integer $kid1Choice
     *
     * @return KidPolicy
     */
    public function setKid1Choice($kid1Choice) {
        $this->kid1_choice = $kid1Choice;

        return $this;
    }

    /**
     * Get kid1Choice
     *
     * @return integer
     */
    public function getKid1Choice() {
        return $this->kid1_choice;
    }

    /**
     * Set kid2Choice
     *
     * @param integer $kid2Choice
     *
     * @return KidPolicy
     */
    public function setKid2Choice($kid2Choice) {
        $this->kid2_choice = $kid2Choice;

        return $this;
    }

    /**
     * Get kid2Choice
     *
     * @return integer
     */
    public function getKid2Choice() {
        return $this->kid2_choice;
    }

    /**
     * Set kid3Choice
     *
     * @param integer $kid3Choice
     *
     * @return KidPolicy
     */
    public function setKid3Choice($kid3Choice) {
        $this->kid3_choice = $kid3Choice;

        return $this;
    }

    /**
     * Get kid3Choice
     *
     * @return integer
     */
    public function getKid3Choice() {
        return $this->kid3_choice;
    }

    /**
     * Set kid4Choice
     *
     * @param integer $kid4Choice
     *
     * @return KidPolicy
     */
    public function setKid4Choice($kid4Choice) {
        $this->kid4_choice = $kid4Choice;

        return $this;
    }

    /**
     * Get kid4Choice
     *
     * @return integer
     */
    public function getKid4Choice() {
        return $this->kid4_choice;
    }

    /**
     * Set hotelprice
     *
     * @param \Daiquiri\AdminBundle\Entity\HotelPrice $hotelprice
     *
     * @return KidPolicy
     */
    public function setHotelprice(\Daiquiri\AdminBundle\Entity\HotelPrice $hotelprice = null) {
        $this->hotelprice = $hotelprice;

        return $this;
    }

    /**
     * Get hotelprice
     *
     * @return \Daiquiri\AdminBundle\Entity\HotelPrice
     */
    public function getHotelprice() {
        return $this->hotelprice;
    }

    /**
     * Set ocupation
     *
     * @param \Daiquiri\AdminBundle\Entity\Ocupation $ocupation
     *
     * @return KidPolicy
     */
    public function setOcupation(\Daiquiri\AdminBundle\Entity\Ocupation $ocupation = null) {
        $this->ocupation = $ocupation;

        return $this;
    }

    /**
     * Get ocupation
     *
     * @return \Daiquiri\AdminBundle\Entity\Ocupation
     */
    public function getOcupation() {
        return $this->ocupation;
    }

    public function getKidValue($n) {

        $value = 0;
        if ($this->campaign) {
            switch ($n) {
                case 2: {
                        if ($this->kid2_choice == 1) {
                            $value = (1 - ($this->kid2 / 100)) * $this->campaign->getBase();
                        } else {
                            $value = $this->v->getBase() - $this->kid2;
                        }
                        break;
                    }
                case 3: {
                        if ($this->kid3_choice == 1) {
                            $value = (1 - ($this->kid3 / 100)) * $this->campaign->getBase();
                        } else {
                            $value = $this->campaign->getBase() - $this->kid3;
                        }
                        break;
                    }
                case 4: {
                        if ($this->kid4_choice == 1) {
                            $value = (1 - ($this->kid4 / 100)) * $this->campaign->getBase();
                        } else {
                            $value = $this->campaign->getBase() - $this->kid4;
                        }
                        break;
                    }
                case 1 : {
                        if ($this->kid1_choice == 1) {
                            $value = (1 - ($this->kid1 / 100)) * $this->campaign->getBase();
                        } else {
                            $value = $this->campaign->getBase() - $this->kid1;
                        }
                        break;
                    }
                default : {
                        $value = 0;
                        break;
                    }
            }
            return $value;
        }

        switch ($n) {
            case 2: {
                    if ($this->kid2_choice == 1) {
                        $value = (1 - ($this->kid2 / 100)) * $this->hotelprice->getBase();
                    } else {
                        $value = $this->hotelprice->getBase() - $this->kid2;
                    }
                    break;
                }
            case 3: {
                    if ($this->kid3_choice == 1) {
                        $value = (1 - ($this->kid3 / 100)) * $this->hotelprice->getBase();
                    } else {
                        $value = $this->hotelprice->getBase() - $this->kid3;
                    }
                    break;
                }
            case 4: {
                    if ($this->kid4_choice == 1) {
                        $value = (1 - ($this->kid4 / 100)) * $this->hotelprice->getBase();
                    } else {
                        $value = $this->hotelprice->getBase() - $this->kid4;
                    }
                    break;
                }
            case 1 : {
                    if ($this->kid1_choice == 1) {
                        $value = (1 - ($this->kid1 / 100)) * $this->hotelprice->getBase();
                    } else {
                        $value = $this->hotelprice->getBase() - $this->kid1;
                    }
                    break;
                }
            default : {
                    $value = 0;
                    break;
                }
        }

        return $value;
    }

    public function getTotalKidValue() {
        if ($this->ocupation->getKids() == 0) {
            return 0;
        } else {
            $value = 0;
            for ($i = 1; $i <= $this->ocupation->getKids(); $i++) {
                $value += $this->getKidValue($i);
            }
        }
        return $value;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return KidPolicy
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignHotel $campaign
     *
     * @return KidPolicy
     */
    public function setCampaign(\Daiquiri\AdminBundle\Entity\CampaignHotel $campaign = null) {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaig
     *
     * @return \Daiquiri\AdminBundle\Entity\CampaignHotel
     */
    public function getCampaign() {
        return $this->campaign;
    }

}
