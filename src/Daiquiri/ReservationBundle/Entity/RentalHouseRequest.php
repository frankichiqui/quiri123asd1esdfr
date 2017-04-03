<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * 
 */
class RentalHouseRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse")
     * @ORM\JoinColumn(name="rentalhouse", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $rentalhouse;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom")
     * @ORM\JoinColumn(name="rentalhouseroom", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $rentalhouseroom;

    /**
     * @var integer
     *
     * @ORM\Column(name="adult", type="integer")
     */
    private $adult;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid", type="integer")
     */
    private $kid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date")
     */
    private $enddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * Set adult
     *
     * @param integer $adult
     *
     * @return RentalHouseRequest
     */
    public function setAdult($adult) {
        $this->adult = $adult;

        return $this;
    }

    /**
     * Get adult
     *
     * @return integer
     */
    public function getAdult() {
        return $this->adult;
    }

    /**
     * Set kid
     *
     * @param integer $kid
     *
     * @return RentalHouseRequest
     */
    public function setKid($kid) {
        $this->kid = $kid;

        return $this;
    }

    /**
     * Get kid
     *
     * @return integer
     */
    public function getKid() {
        return $this->kid;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return RentalHouseRequest
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate() {
        return $this->enddate;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return RentalHouseRequest
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * Set rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     *
     * @return RentalHouseRequest
     */
    public function setRentalhouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse = null) {
        $this->rentalhouse = $rentalhouse;

        return $this;
    }

    /**
     * Get rentalhouse
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouse
     */
    public function getRentalhouse() {
        return $this->rentalhouse;
    }

    /**
     * Set rentalhouseroom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom
     *
     * @return RentalHouseRequest
     */
    public function setRentalhouseroom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalhouseroom = null) {
        $this->rentalhouseroom = $rentalhouseroom;

        return $this;
    }

    /**
     * Get rentalhouseroom
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouseRoom
     */
    public function getRentalhouseroom() {
        return $this->rentalhouseroom;
    }

    public static function getRootViewFolder() {
        return 'RentalHouse';
    }

    public function getFullInfo() {
        return 'RentalHouse : ' . $this->rentalhouse .
                ' Room :' . $this->rentalhouseroom . ' Check in: ' . $this->startdate->format('M j Y') . ' Check out: ' . $this->enddate->format('M j Y') . ' Adults: ' . $this->adult . ' Kids: ' . $this->kid;
    }

}
