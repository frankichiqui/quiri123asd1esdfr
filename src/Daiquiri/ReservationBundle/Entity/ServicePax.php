<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServicePax
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ServicePax {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="birthdate", type="date", length=255)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255)
     */
    private $document;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Gender
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\ReservationBundle\Entity\Gender", inversedBy="service_paxs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gender", referencedColumnName="id")
     * })
     */
    private $gender;

    /**
     * @var \Daiquiri\ReservationBundle\Entity\Service
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\ReservationBundle\Entity\Service", inversedBy="servicepaxs", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service", referencedColumnName="id")
     * })
     */
    private $service;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ServicePax
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return ServicePax
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set document
     *
     * @param string $document
     *
     * @return ServicePax
     */
    public function setDocument($document) {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument() {
        return $this->document;
    }

    /**
     * Set gender
     *
     * @param \Daiquiri\ReservationBundle\Entity\Gender $gender
     *
     * @return ServicePax
     */
    public function setGender(\Daiquiri\ReservationBundle\Entity\Gender $gender = null) {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return \Daiquiri\ReservationBundle\Entity\Gender
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Set service
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $service
     *
     * @return ServicePax
     */
    public function setService(\Daiquiri\ReservationBundle\Entity\Service $service = null) {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Daiquiri\ReservationBundle\Entity\Service
     */
    public function getService() {
        return $this->service;
    }

    public function __toString() {
        return strtoupper($this->getGender() . " " . $this->name . " " . $this->lastname);
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return ServicePax
     */
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate() {
        return $this->birthdate;
    }
    
    public function __construct() {
        $this->birthdate =  (new \DateTime('now'))->modify('-18 years');
    }
    
    public function getAge() {
        return $this->birthdate->diff(new \DateTime('today'))->y;
    }
}
