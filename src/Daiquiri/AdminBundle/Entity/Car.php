<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CarRepository")
 */
class Car extends Product {

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
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="air_conditioner", type="boolean")
     */
    private $airConditioner;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cd_player", type="boolean")
     */
    private $cdPlayer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="transsmission", type="boolean", nullable=true)
     */
    private $transsmission;

    /**
     * @var boolean
     *
     * @ORM\Column(name="clima", type="boolean", nullable=true)
     */
    private $clima;

    /**
     * @var boolean
     *
     * @ORM\Column(name="satellite", type="boolean", nullable=true)
     */
    private $satellite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="powerdoorslock", type="boolean", nullable=true)
     */
    private $powerdoorslock;

    /**
     * @var boolean
     *
     * @ORM\Column(name="powerwindow", type="boolean", nullable=true)
     */
    private $powerwindow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tilt", type="boolean", nullable=true)
     */
    private $tilt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="radio", type="boolean", nullable=true)
     */
    private $radio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="shuttlebus", type="boolean", nullable=true)
     */
    private $shuttlebus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="terminalpickup", type="boolean", nullable=true)
     */
    private $terminalpickup;

    /**
     * @var integer
     *
     * @ORM\Column(name="power", type="integer", nullable=true)
     */
    private $power;

    /**
     * @var integer
     *
     * @ORM\Column(name="doors", type="integer")
     */
    private $doors;

    /**
     * @var string
     *
     * @ORM\Column(name="engine", type="string", length=255, nullable=true)
     */
    private $engine;

    /**
     * @var \Daiquiri\AdminBundle\Entity\CarClass
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CarClass", inversedBy="cars" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="car_class", referencedColumnName="id")
     * })
     */
    private $carClass;

    /**
     * @var \Daiquiri\AdminBundle\Entity\LuggageCapacity
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\LuggageCapacity", inversedBy="cars")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="car_luggage_capacity", referencedColumnName="id")
     * })
     */
    private $luggagecapacity;

    /**
     * @var \Daiquiri\AdminBundle\Entity\CarCategory
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\CarCategory", inversedBy="cars")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="car_category", referencedColumnName="id")
     * })
     */
    private $carCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Driver", mappedBy="cars", cascade={"persist","refresh"})
     */
    private $drivers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\CarAvailability", mappedBy="cars")
     */
    private $car_availabilitys;

    /**
     * @ORM\OneToMany(targetEntity="CampaignCar", mappedBy="car")
     */
    private $campaigns;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\CarSeason", mappedBy="car", cascade={"all"})
     */
    private $carseason;   

    /**
     * Constructor
     */
    public function __construct() {
        $this->drivers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->carseason = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function isDepartureDate(\DateTime $date) {

        if (!$date || !Validate::isMoreThanMinDate($date)) {
            return false;
        }


        foreach ($this->car_availabilitys as $ca) {
            if ($ca->getDate()->format('M j, Y') == $date->format('M j, Y')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set transsmission
     *
     * @param boolean $transsmission
     *
     * @return Car
     */
    public function setTranssmission($transsmission) {
        $this->transsmission = $transsmission;

        return $this;
    }

    /**
     * Get transsmission
     *
     * @return boolean
     */
    public function getTranssmission() {
        return $this->transsmission;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Car
     */
    public function setCapacity($capacity) {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity() {
        return $this->capacity;
    }

    /**
     * Set airConditioner
     *
     * @param boolean $airConditioner
     *
     * @return Car
     */
    public function setAirConditioner($airConditioner) {
        $this->airConditioner = $airConditioner;

        return $this;
    }

    /**
     * Get airConditioner
     *
     * @return boolean
     */
    public function getAirConditioner() {
        return $this->airConditioner;
    }

    /**
     * Set cdPlayer
     *
     * @param boolean $cdPlayer
     *
     * @return Car
     */
    public function setCdPlayer($cdPlayer) {
        $this->cdPlayer = $cdPlayer;

        return $this;
    }

    /**
     * Get cdPlayer
     *
     * @return boolean
     */
    public function getCdPlayer() {
        return $this->cdPlayer;
    }

    /**
     * Set doors
     *
     * @param integer $doors
     *
     * @return Car
     */
    public function setDoors($doors) {
        $this->doors = $doors;

        return $this;
    }

    /**
     * Get doors
     *
     * @return integer
     */
    public function getDoors() {
        return $this->doors;
    }

    /**
     * Set engine
     *
     * @param string $engine
     *
     * @return Car
     */
    public function setEngine($engine) {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get engine
     *
     * @return string
     */
    public function getEngine() {
        return $this->engine;
    }

    /**
     * Set carClass
     *
     * @param \Daiquiri\AdminBundle\Entity\CarClass $carClass
     *
     * @return Car
     */
    public function setCarClass(\Daiquiri\AdminBundle\Entity\CarClass $carClass = null) {
        $this->carClass = $carClass;

        return $this;
    }

    /**
     * Get carClass
     *
     * @return \Daiquiri\AdminBundle\Entity\CarClass
     */
    public function getCarClass() {
        return $this->carClass;
    }

    /**
     * Set carCategory
     *
     * @param \Daiquiri\AdminBundle\Entity\CarCategory $carCategory
     *
     * @return Car
     */
    public function setCarCategory(\Daiquiri\AdminBundle\Entity\CarCategory $carCategory = null) {
        $this->carCategory = $carCategory;

        return $this;
    }

    /**
     * Get carCategory
     *
     * @return \Daiquiri\AdminBundle\Entity\CarCategory
     */
    public function getCarCategory() {
        return $this->carCategory;
    }

    /**
     * Add driver
     *
     * @param \Daiquiri\AdminBundle\Entity\Driver $driver
     *
     * @return Car
     */
    public function addDriver(\Daiquiri\AdminBundle\Entity\Driver $driver) {
        $driver->addCar($this);
        $this->drivers[] = $driver;
        return $this;
    }

    /**
     * Remove driver
     *
     * @param \Daiquiri\AdminBundle\Entity\Driver $driver
     */
    public function removeDriver(\Daiquiri\AdminBundle\Entity\Driver $driver) {
        $driver->removeCar($this);
        $this->drivers->removeElement($driver);
    }

    /**
     * Get drivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDrivers() {
        return $this->drivers;
    }

    /**
     * Set luggagecapacity
     *
     * @param \Daiquiri\AdminBundle\Entity\LuggageCapacity $luggagecapacity
     *
     * @return Car
     */
    public function setLuggagecapacity(\Daiquiri\AdminBundle\Entity\LuggageCapacity $luggagecapacity = null) {
        $this->luggagecapacity = $luggagecapacity;

        return $this;
    }

    /**
     * Get luggagecapacity
     *
     * @return \Daiquiri\AdminBundle\Entity\LuggageCapacity
     */
    public function getLuggagecapacity() {
        return $this->luggagecapacity;
    }

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->campaigns as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                $this->current_offert[] = $c;
            }
        }
    }

    public $current_offert;

    public function getTotalPrice(\DateTime $startdate, \DateTime $enddate, Market $market) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($startdate, $interval, $enddate);
        $suma = 0;
        foreach ($daterange as $date) {
            $this->getCampaignForDate($date, $market);
            if ($this->current_offert) {
                $suma += $this->getPriceForDate($date) - $this->getMinCampaign()->getCardiscount();
            } else {
                $suma+=$this->getPriceForDate($date);
            }
        }
        return $suma * (1 + $increment);
        $this->current_offert = array();
    }

    public function getPriceForDate(\DateTime $date) {
        foreach ($this->carseason as $season) {
            if ($season->getStartdate() <= $date && $season->getEnddate() >= $date) {
                return $season->getPrice();
            }
            return 0;
        }
    }

    public function getMinCampaign() {
        if ($this->current_offert) {
            $c = $this->current_offert[0];
            foreach ($this->current_offert as $cu) {
                if ($c->getCardiscount() < $cu->getCardiscount()) {
                    $c = $cu;
                }
            }
            return $c;
        }
        return;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice(\Daiquiri\ReservationBundle\Entity\CarItem $caritem = null, Market $m = null) {
        if (!$caritem) {
            return $this->getPriceForDate(new \DateTime('today'));
        }

        return $this->getTotalPrice($caritem->getStartdate(), $caritem->getEnddate(), $m);
    }

    /**
     * Add carAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\CarAvailability $carAvailability
     *
     * @return Car
     */
    public function addCarAvailability(\Daiquiri\AdminBundle\Entity\CarAvailability $carAvailability) {

        $this->car_availabilitys[] = $carAvailability;
        $carAvailability->addCar($this);


        return $this;
    }

    /**
     * Remove carAvailability
     *
     * @param \Daiquiri\AdminBundle\Entity\CarAvailability $carAvailability
     */
    public function removeCarAvailability(\Daiquiri\AdminBundle\Entity\CarAvailability $carAvailability) {
        $this->car_availabilitys->removeElement($carAvailability);
        $carAvailability->removeElement($this);
    }

    /**
     * Get carAvailabilitys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarAvailabilitys() {
        return $this->car_availabilitys;
    }

    public function hasCarAvailability(\Daiquiri\AdminBundle\Entity\CarAvailability $carAvailability) {
        if (count($this->car_availabilitys) > 0) {
            foreach ($this->car_availabilitys as $av) {
                if ($carAvailability->getDate() == $av->getDate()) {
                    return true;
                }
            }
            return FALSE;
        }
    }

    public function isAvailableInDate(\DateTime $date) {
        if (count($this->car_availabilitys) > 0) {
            foreach ($this->car_availabilitys as $av) {
                if ($date->format("M j, Y") == $av->getDate()->format("M j, Y")) {
//                    print $date->format("Y-m-d"). '==' .$av->getDate()->format("Y-m-d");
//                    dump($date->format("Y-m-d") == $av->getDate()->format("Y-m-d"));die;
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function isAvailableInDateRange(\DateTime $startdate, \DateTime $enddate) {
        if ($startdate < $enddate) {
            $interval = new \DateInterval('P1D');
            $daterange = new \DatePeriod($startdate, $interval, $enddate->modify('+1 day'));
            foreach ($daterange as $date) {
                if (!$this->isAvailableInDate($date)) {
                    $enddate->modify('-1 day');
                    return false;
                }
            }
        } else {
            $enddate->modify('-1 day');
            return false;
        }
        $enddate->modify('-1 day');
        return true;
    }

    public function hasDriver(Driver $driver = null) {
        if (!$driver) {
            if ($this->drivers->count() == 0) {
                return true;
            }
            return false;
        }

        if ($this->drivers->count() > 0) {
            foreach ($this->drivers as $d) {
                if ($driver->getId() == $d->getId()) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignCar $campaign
     *
     * @return Car
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignCar $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignCar $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignCar $campaign) {
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

    public function getCampaignToDate(\DateTime $date, Market $m) {
        foreach ($this->campaigns as $c) {
            if ($c->getStartdate()->format('Y-m-d') == $date->format('Y-m-d') && $c->getAvailable() && $c->getMarkets()->contains($m)) {
                return $c;
            }
        }
        return;
    }

    /**
     * Set clima
     *
     * @param boolean $clima
     *
     * @return Car
     */
    public function setClima($clima) {
        $this->clima = $clima;

        return $this;
    }

    /**
     * Get clima
     *
     * @return boolean
     */
    public function getClima() {
        return $this->clima;
    }

    /**
     * Set tilt
     *
     * @param boolean $tilt
     *
     * @return Car
     */
    public function setTilt($tilt) {
        $this->tilt = $tilt;

        return $this;
    }

    /**
     * Get tilt
     *
     * @return boolean
     */
    public function getTilt() {
        return $this->clima;
    }

    /**
     * Set satellite
     *
     * @param boolean $satellite
     *
     * @return Car
     */
    public function setSatellite($satellite) {
        $this->satellite = $satellite;

        return $this;
    }

    /**
     * Get satellite
     *
     * @return boolean
     */
    public function getSatellite() {
        return $this->satellite;
    }

    /**
     * Set radio
     *
     * @param boolean $radio
     *
     * @return Car
     */
    public function setRadio($radio) {
        $this->radio = $radio;

        return $this;
    }

    /**
     * Get radio
     *
     * @return boolean
     */
    public function getRadio() {
        return $this->radio;
    }

    /**
     * Set powerwindow
     *
     * @param boolean $powerwindow
     *
     * @return Car
     */
    public function setPowerwindow($powerwindow) {
        $this->powerwindow = $powerwindow;

        return $this;
    }

    /**
     * Get powerwindow
     *
     * @return boolean
     */
    public function getPowerwindow() {
        return $this->powerwindow;
    }

    /**
     * Set powerdoorslock
     *
     * @param boolean $powerdoorslock
     *
     * @return Car
     */
    public function setPowerdoorslock($powerdoorslock) {
        $this->powerdoorslock = $powerdoorslock;

        return $this;
    }

    /**
     * Get powerdoorslock
     *
     * @return boolean
     */
    public function getPowerdoorslock() {
        return $this->powerdoorslock;
    }

    /**
     * Set power
     *
     * @param integer $power
     *
     * @return Car
     */
    public function setPower($power) {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return boolean
     */
    public function getPower() {
        return $this->power;
    }

    /**
     * Get terminalpickup
     *
     * @return boolean
     */
    public function getTerminalpickup() {
        return $this->terminalpickup;
    }

    /**
     * Set terminalpickup
     *
     * @param integer $terminalpickup
     *
     * @return Car
     */
    public function setTerminalpickup($terminalpickup) {
        $this->terminalpickup = $terminalpickup;

        return $this;
    }

    /**
     * Get shuttlebus
     *
     * @return boolean
     */
    public function getShuttlebus() {
        return $this->shuttlebus;
    }

    /**
     * Set shuttlebus
     *
     * @param integer $shuttlebus
     *
     * @return Car
     */
    public function setShuttlebus($shuttlebus) {
        $this->shuttlebus = $shuttlebus;

        return $this;
    }

    public function getFromprice() {
        $min = 77777777777;
        foreach ($this->carseason as $s) {
            if ($s->getPrice() < $min) {
                $min = $s->getPrice();
            }
        }
        if ($min == 77777777777) {
            return 0;
        }
        return $min;
    }

    /**
     * Add carseason
     *
     * @param \Daiquiri\AdminBundle\Entity\CarSeason $carseason
     *
     * @return Car
     */
    public function addCarseason(\Daiquiri\AdminBundle\Entity\CarSeason $carseason) {
        $this->carseason[] = $carseason;
        $carseason->setCar($this);
        return $this;
    }

    /**
     * Remove carseason
     *
     * @param \Daiquiri\AdminBundle\Entity\CarSeason $carseason
     */
    public function removeCarseason(\Daiquiri\AdminBundle\Entity\CarSeason $carseason) {
        $this->carseason->removeElement($carseason);
        $carseason->setCar(null);
    }

    /**
     * Get carseason
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarseason() {
        return $this->carseason;
    }

    public function setCarseason(\Doctrine\Common\Collections\Collection $carSeason) {
        if (count($carSeason) > 0) {
            foreach ($carSeason as $c) {
               // if (!$this->carseason->contains($c)) {
                    $this->addCarseason($c);
               // }
            }
        }
        return $this;
    }

}
