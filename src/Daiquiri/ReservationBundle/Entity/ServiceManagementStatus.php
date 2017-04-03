<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceManagementStatus
 *
 * @ORM\Table()
 * @ORM\Entity
 */
    class ServiceManagementStatus
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

  
    
    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\Service", mappedBy="servicemanagementstatus")
     */
    private $services;


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
     * Set status
     *
     * @param string $status
     *
     * @return ServiceManagementStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return ServiceManagementStatus
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

   
     
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add service
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $service
     *
     * @return ServiceManagementStatus
     */
    public function addService(\Daiquiri\ReservationBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $service
     */
    public function removeService(\Daiquiri\ReservationBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
    
    public function __toString() {
        return ($this->status)?($this->status):"";
    }

    
}
