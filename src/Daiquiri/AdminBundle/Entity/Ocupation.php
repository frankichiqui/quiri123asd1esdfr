<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ocupation
 *
 * @ORM\Table(name="ocupation", indexes={@ORM\Index(name="IDX_C1A3AD60729F519B", columns={"room"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\OcupationRepository")
 */
class Ocupation extends Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Slug(fields={"id", "title"})
     */
    private $uniqueSlug;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer", nullable=true)
     */
    private $kids;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer", nullable=true)
     */
    private $adults;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Room
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Room", inversedBy="ocupations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room", referencedColumnName="id")
     * })
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\KidPolicy", mappedBy="ocupation")
     */
    private $kidpolicy;

    /**
     * 
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->setAvailable(true);
        $this->room_season_ocupation_prices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kidpolicy = new \Doctrine\Common\Collections\ArrayCollection();
        $this->title = "(" . $this->getAdults() . " - " . $this->getKids() . ")";
    }

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return Ocupation
     */
    public function setKids($kids) {
        $this->kids = $kids;
        $this->title = "(" . $this->getAdults() . " - " . $this->getKids() . ")";

        return $this;
    }

    /**
     * Get kids
     *
     * @return integer
     */
    public function getKids() {
        return $this->kids;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return Ocupation
     */
    public function setAdults($adults) {
        $this->adults = $adults;
        $this->title = "(" . $this->getAdults() . " - " . $this->getKids() . ")";

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults() {
        return $this->adults;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Ocupation
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return Ocupation
     */
    public function setUniqueSlug($uniqueSlug) {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug() {
        return $this->uniqueSlug;
    }

    public function __toString() {
        return $this->room . " (" . $this->getAdults() . " - " . $this->getKids() . ")";
    }

    /**
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return Ocupation
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

    public function hasOnlyAdults() {
        if ($this->adults > 0 && $this->kids == 0) {
            return true;
        }
        return FALSE;
    }

    public function hasOnlyKids() {
        if ($this->kids > 0 && $this->adults == 0) {
            return true;
        }
        return FALSE;
    }

    //override of method in Product
    public function getTermConditionProduct() {
        return $this->getRoom()->getHotel()->getTermConditionHotel();
    }

    //override of method in Product    
    public function getCancelationProduct() {
        return $this->getRoom()->getHotel()->getCancelationHotel();
    }

    //override of method in Product   
    public function getDocuments() {
        return $this->getRoom()->getHotel()->getDocuments();
    }

    public function getTitle() {
        return "ocupation" . $this->getAdults() . $this->getKids();
    }

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->getRoom()->getCampaigns() as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                $this->current_offert[] = $c;
            }
        }

        return null;
    }

    public $current_offert;

    public function getMinCampaign() {
        if ($this->current_offert) {
            $c = $this->current_offert[0];
            foreach ($this->current_offert as $cu) {
                if ($c->getPrice($this) < $cu->getPrice($this)) {
                    $c = $cu;
                }
            }
            return $c;
        }
        return;
    }

    public function getPriceByDate(\DateTime $date, Market $market) {
        $season = $this->getRoom()->getHotel()->getSeasonByDate($date);
        $this->getCampaignForDate($date, $market);
        if ($this->current_offert) {
            $suplement = $this->getRoom()->getHotel()->getSuplementByDate($date);
            return $this->getMinCampaign()->getPrice($this) + $suplement;
        }

        //dump($this->kidpolicy);die;
        if ($season) {
            foreach ($this->kidpolicy as $kp) {
                if ($kp->getHotelPrice()) {
                    if ($kp->getHotelPrice()->getSeason()->getId() == $season->getId()) {
                        $suplement = $this->getRoom()->getHotel()->getSuplementByDate($date);
                        if ($suplement) {
                            return $kp->getPrice() + $suplement->getTotalValue($this);
                        }
                        return $kp->getPrice();
                    }
                }
            }
        } else {
            return null;
        }
    }

    public function getPriceByDateRange(\DateTime $startdate, \DateTime $enddate, Market $market) {
        $interval = new \DateInterval('P1D');
        $final = $enddate;
        $price = 0;
        $daterange = new \DatePeriod($startdate, $interval, $final);
        foreach ($daterange as $date) {

            $p = $this->getPriceByDate($date, $market);

            if (!$p) {
                return null;
            } else {
                $price+=$p;
            }
        }
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }


        return $price * (1 + $increment);
    }

    public function getPrice(\Daiquiri\ReservationBundle\Entity\OcupationItem $item, Market $market) {
        $price = $this->getPriceByDateRange($item->getStartdate(), $item->getEnddate(), $market) * $item->getQuantity();
        return $price;
    }

    /**
     * Add kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     *
     * @return Ocupation
     */
    public function addKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $this->kidpolicy[] = $kidpolicy;

        return $this;
    }

    /**
     * Remove kidpolicy
     *
     * @param \Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy
     */
    public function removeKidpolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {
        $this->kidpolicy->removeElement($kidpolicy);
    }

    /**
     * Get kidpolicy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKidpolicy() {
        return $this->kidpolicy;
    }

    public function setProductIncrement(\Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement = null) {
        if ($this->room) {
            if ($this->room->getHotel()) {
                $this->room->getHotel()->setProductIncrement($productIncrement);
            }
        }

        return $this;
    }

    public function getProductIncrement() {
        if ($this->room) {
            if ($this->room->getHotel()) {
                return $this->room->getHotel()->getProductIncrement();
            }
        }
        return null;
    }

    public function hotelroomocupation() {
        $salida = "";
        if ($this->room) {
            $salida .= $this->room->getTitle() . ' ';
            if ($this->room->getHotel()) {
                $salida = strtoupper($this->room->getHotel()->getTitle()) . ' ' . $salida . ' ';
                if ($this->room->getHotel()->getChain()) {
                    $salida = strtoupper($this->room->getHotel()->getChain()->getTitle()) . ' ' . $salida . ' ';
                }
            }
        }
        return $salida . '(' . $this->getAdults() . '-' . $this->getKids() . ')';
    }

    public function showIconOcupation() {
        $salida = '';
        for ($i = 0; $i < $this->adults; $i++) {
            $salida .= '<i class="fa fa-user fa-lg"></i>';
        }
        $salida .= ' ';
        for ($i = 0; $i < $this->kids; $i++) {
            $salida .= '<i class="fa fa-user"></i>';
        }
        return $salida;
    }

}
