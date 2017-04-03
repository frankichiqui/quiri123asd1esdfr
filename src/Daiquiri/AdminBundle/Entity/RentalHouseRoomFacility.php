<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouseRoomFacility
 *
 * @ORM\Table(name="rental_house_room_facility")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseRoomFacilityRepository")
 */
class RentalHouseRoomFacility {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_room_facility_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="faicon", type="string", length=255, nullable=true)
     */
    private $faicon;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"id", "title"})
     */
    private $uniqueSlug;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouseRoom", mappedBy="rental_house_room_facilities")
     */
    private $rental_house_rooms;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Room", mappedBy="room_facilities")
     */
    private $rooms;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return RentalHouseRoomFacility
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->rental_house_rooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set faicon
     *
     * @param string $faicon
     *
     * @return RentalHouseRoomFacility
     */
    public function setFaicon($faicon) {
        $this->faicon = $faicon;

        return $this;
    }

    /**
     * Get faicon
     *
     * @return string
     */
    public function getFaicon() {
        return $this->faicon;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return RentalHouseRoomFacility
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
     * @return RentalHouseRoomFacility
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

    /**
     * Add rentalHouseRoom
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouseRoom $rentalHouseRoom
     *
     * @return RentalHouseRoomFacility
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

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return RentalHouseRoomFacility
     */
    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale() {
        return $this->locale;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }


    /**
     * Add room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     *
     * @return RentalHouseRoomFacility
     */
    public function addRoom(\Daiquiri\AdminBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \Daiquiri\AdminBundle\Entity\Room $room
     */
    public function removeRoom(\Daiquiri\AdminBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}
