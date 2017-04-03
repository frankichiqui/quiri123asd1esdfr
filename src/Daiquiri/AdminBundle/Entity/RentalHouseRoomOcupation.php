<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalHouseRoomOcupation
 *
 * @ORM\Table(name="rental_house_room_ocupation")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseRoomOcupationRepository")
 */
class RentalHouseRoomOcupation {

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
     * @ORM\Column(name="adult", type="integer", nullable=true)
     */
    private $adult;

    /**
     * @var integer
     *
     * @ORM\Column(name="kid", type="integer", nullable=true)
     */
    private $kid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom", mappedBy="rental_house_room_ocupations")
     */
    private $rental_house_rooms;

    /**
     * Constructor
     */
    public function __construct() {
        $this->rental_house_rooms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set adult
     *
     * @param integer $adult
     *
     * @return RentalHouseRoomOcupation
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
     * @return RentalHouseRoomOcupation
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
     * Add rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     *
     * @return RentalHouseRoomOcupation
     */
    public function addRentalHouseRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom) {
        $this->rental_house_rooms[] = $rentalHouseRoom;

        return $this;
    }

    /**
     * Remove rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     */
    public function removeRentalHouseRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom) {
        $this->rental_house_rooms->removeElement($rentalHouseRoom);
    }

    /**
     * Get rentalHouseRooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouseRooms() {
        return $this->rental_house_rooms;
    }

    public function __toString() {
        return ($this->getAdult() . '-' . $this->getKid()) ? : '';
    }

}
