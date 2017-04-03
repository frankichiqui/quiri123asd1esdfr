<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampaingCircuit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CampaignRentalHouse extends Campaign {

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
     * @ORM\Column(name="roomdiscount", type="float")
     */
    private $roomdiscount;

    /**
     * @ORM\ManyToMany(targetEntity="RentalHouseRoom", mappedBy="campaigns")
     */
    private $rentalhouserooms;

    public function getproduct() {
        return $this->rentalhouserooms;
    }

    /**
     * Set roomdiscount
     *
     * @param float $roomdiscount
     *
     * @return CampaignRentalHouse
     */
    public function setRoomdiscount($roomdiscount) {
        $this->roomdiscount = $roomdiscount;

        return $this;
    }

    /**
     * Get roomdiscount
     *
     * @return float
     */
    public function getRoomdiscount() {
        return $this->roomdiscount;
    }

    public function __construct() {
        $this->rentalhouserooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rentalhouseroom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom
     *
     * @return CampaignRentalHouse
     */
    public function addRentalhouseroom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom) {
        $rentalhouseroom->addCampaign($this);
        $this->rentalhouserooms[] = $rentalhouseroom;

        return $this;
    }

    /**
     * Remove rentalhouseroom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom
     */
    public function removeRentalhouseroom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom) {
        $rentalhouseroom->removeCampaign($this);
        $this->rentalhouserooms->removeElement($rentalhouseroom);
    }

    /**
     * Get rentalhouserooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalhouserooms() {
        return $this->rentalhouserooms;
    }

}
