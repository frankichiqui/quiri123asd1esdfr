<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigurationTPV
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"ConfigurationPam"="ConfigurationPam", "ConfigurationTPV"="ConfigurationTPV"})
 */
class ConfigurationTPV {

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var float
     *
     * @ORM\Column(name="tax", type="float")
     */
    private $tax;

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
     * @return ConfigurationTPV
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return ConfigurationTPV
     */
    public function setCompanyName($companyName) {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName() {
        return $this->companyName;
    }

    /**
     * Set tax
     *
     * @param float $tax
     *
     * @return ConfigurationTPV
     */
    public function setTax($tax) {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return float
     */
    public function getTax() {
        return $this->tax;
    }

}
