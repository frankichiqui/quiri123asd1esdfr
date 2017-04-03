<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Airport
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\AirportRepository")
 */
class Airport extends Place {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Flight", mappedBy="airports")
     */
    private $flights;

    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * Constructor
     */
    public function __construct() {
        $this->flights = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }

    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale() {
        return $this->locale;
    }

    /**
     * Add flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     *
     * @return Airport
     */
    public function addFlight(\Daiquiri\AdminBundle\Entity\Flight $flight) {
        $flight->addAirport($this);
        $this->flights->add($flight);

        return $this;
    }

    /**
     * Remove flight
     *
     * @param \Daiquiri\AdminBundle\Entity\Flight $flight
     */
    public function removeFlight(\Daiquiri\AdminBundle\Entity\Flight $flight) {
        $flight->removeAirport($this);
        $this->flights->removeElement($flight);
    }

    /**
     * Get flights
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlights() {
        return $this->flights;
    }

    public function setFlihgts($flights) {
        if (count($flights) > 0) {
            foreach ($flights as $f) {
                if (!$this->flights->contains($f)) {
                    $this->addFlight($f);
                }
            }
        }
        return $this;
    }

    public function fullTitle() {
        return 'Airport ' . $this->getTitle();
    }

    public function getIconClass() {
        return 'fa fa-plane';
    }


    /**
     * Set address
     *
     * @param string $address
     *
     * @return Airport
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Airport
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
