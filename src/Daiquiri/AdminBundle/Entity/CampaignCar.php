<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignCar extends Campaign {

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
     * @ORM\Column(name="cardiscount", type="float")
     */
    private $cardiscount;

   
    /**
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="campaigns")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id", nullable=true)
     */
    private $car;

    

    /**
     * Get kiddiscounttype
     *
     * @return integer
     */
    public function getKiddiscounttype() {
        return $this->kiddiscounttype;
    }
    public function getproduct() {
        return $this->car;
    }

    /**
     * Set car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return CampaignCar
     */
    public function setCar(\Daiquiri\AdminBundle\Entity\Car $car = null) {
        $this->car = $car;
        return $this;
    }

    /**
     * Get car
     *
     * @return \Daiquiri\AdminBundle\Entity\Car
     */
    public function getCar() {
        return $this->car;
    }

    /**
     * Set cardiscount
     *
     * @param float $cardiscount
     *
     * @return CampaignCar
     */
    public function setCardiscount($cardiscount) {
        $this->cardiscount = $cardiscount;

        return $this;
    }

    /**
     * Get cardiscount
     *
     * @return float
     */
    public function getCardiscount() {
        return $this->cardiscount;
    }

  

}
