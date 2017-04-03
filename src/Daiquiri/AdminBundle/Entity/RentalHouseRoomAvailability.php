<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RentalHouseAvailability
 *
 * @ORM\Table(name="rental_house_room_availability", indexes={@ORM\Index(name="IDX_CF5EB5BFBAF18227", columns={"rental_house_room"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailabilityRepository")
 */
class RentalHouseRoomAvailability {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_availability_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \Daiquiri\AdminBundle\Entity\RentalHouseRoom
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom", inversedBy="rental_house_room_availabilities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rental_house_room", referencedColumnName="id")
     * })
     */
    private $rental_house_room;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

   

    public function __toString() {
        return $this->date->format("M j, Y");
    }

    /**
     * Set rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     *
     * @return RentalHouseRoomAvailability
     */
    public function setRentalHouseRoom(\Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom = null) {
        $this->rental_house_room = $rentalHouseRoom;

        return $this;
    }

    /**
     * Get rentalHouseRoom
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouseRoom
     */
    public function getRentalHouseRoom() {
        return $this->rental_house_room;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return RentalHouseRoomAvailability
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
