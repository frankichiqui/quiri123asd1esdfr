<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarAvailability
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CarAvailabilityRepository")
 */
class CarAvailability
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;
     /**
     *  @var \Doctrine\Common\Collections\Collection
     *      * 
     * @ORM\ManyToMany(targetEntity="Car", inversedBy="car_availabilitys")
     * @ORM\JoinTable(name="car_availabilitys_car")
     */     
    private $cars;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CarAvailability
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     *
     * @return CarAvailability
     */
    public function addCar(\Daiquiri\AdminBundle\Entity\Car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \Daiquiri\AdminBundle\Entity\Car $car
     */
    public function removeCar(\Daiquiri\AdminBundle\Entity\Car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCars()
    {
        return $this->cars;
    }
}
