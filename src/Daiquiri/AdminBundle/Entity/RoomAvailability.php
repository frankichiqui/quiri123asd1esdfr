<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomAvailability
 *
 * @ORM\Table(name="room_availability", indexes={@ORM\Index(name="IDX_89C5BA2C729F519B", columns={"room"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RoomAvailabilityRepository")
 */
class RoomAvailability {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="room_availability_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;


    /**
     * @var \Daiquiri\AdminBundle\Entity\Room
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Room", inversedBy="room_availabilitys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room", referencedColumnName="id")
     * })
     */
    private $room;

    /**
     * Set room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return RoomAvailability
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


    public function __toString() {
        return $this->date->format("M j, Y");

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return RoomAvailability
     */

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */

    public function getDate() {
        return $this->date;
    }


}
