<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalHouseRoomItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RentalHouseRoomItem extends CartItem {

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * 
     *
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="realid", type="integer")
     * @ORM\Id
     * 
     */
    protected $realid;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="rentalhouse", referencedColumnName="id")
     */
    private $rentalhouse;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="room", referencedColumnName="id")
     */
    private $room;

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
     * @var front     
     */
    private $front;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->adult; $i++) {
            $salida[] = 1;
        }
        for ($i = 0; $i < $this->quantity * $this->kid; $i++) {
            $salida[] = 2;
        }

        return $salida;
        // return array('adults' => $this->quantity * $this->adults, 'kids' => $this->quantity * $this->kids, 'infants' => 0);
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return RentalHouseRoomItem
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

    //metodo para identicar un elemento a un carrito
    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product .
                $this->startdate->format('M j, Y') .
                $this->enddate->format('M j, Y') .
                $this->rentalhouse .
                $this->adult .
                $this->kid .
                $this->room);
    }

    public function getDiffDays() {

        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set adult
     *
     * @param integer $adult
     *
     * @return RentalHouseRoomItem
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
     * @return RentalHouseRoomItem
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
     * Set id
     *
     * @param string $id
     *
     * @return RentalHouseRoomItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     *
     * @return RentalHouseRoomItem
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
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $room
     *
     * @return RentalHouseRoomItem
     */
    public function setRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $room = null) {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouseRoom
     */
    public function getRoom() {
        return $this->room;
    }

    public function getRootFolder() {
        return 'RentalHouse';
    }

    public function getSpecifications() {
        return $this->adult . ',' . $this->kid;
    }

    /**
     * Set realid
     *
     * @param integer $realid
     *
     * @return RentalHouseRoomItem
     */
    public function setRealid($realid) {
        $this->realid = $realid;

        return $this;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return RentalHouseRoomItem
     */
    public function setFront($front) {
        $this->front = $front;

        return $this;
    }

    /**
     * Get front
     *
     * @return boolean
     */
    public function getFront() {
        return $this->front;
    }

}
