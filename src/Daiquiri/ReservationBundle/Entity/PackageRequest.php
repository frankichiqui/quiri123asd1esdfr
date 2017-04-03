<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageRequest
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PackageRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Package")
     * @ORM\JoinColumn(name="package", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $package;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\PackageOption")
     * @ORM\JoinColumn(name="packageoption", referencedColumnName="id", nullable = true)
     */
    private $packageoption;

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
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    /**
     * Set adult
     *
     * @param integer $adult
     *
     * @return PackageRequest
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
     * @return PackageRequest
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
     * Set package
     *
     * @param \Daiquiri\AdminBundle\Entity\Package $package
     *
     * @return PackageRequest
     */
    public function setPackage(\Daiquiri\AdminBundle\Entity\Package $package = null) {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Daiquiri\AdminBundle\Entity\Package
     */
    public function getPackage() {
        return $this->package;
    }

    /**
     * Set packageoption
     *
     * @param \Daiquiri\AdminBundle\Entity\PackageOption $packageoption
     *
     * @return PackageRequest
     */
    public function setPackageoption(\Daiquiri\AdminBundle\Entity\PackageOption $packageoption = null) {
        $this->packageoption = $packageoption;

        return $this;
    }

    /**
     * Get packageoption
     *
     * @return \Daiquiri\AdminBundle\Entity\PackageOption
     */
    public function getPackageoption() {
        return $this->packageoption;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return PackageRequest
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate() {
        return $this->startdate;
    }

    public static function getRootViewFolder() {
        return 'Package';
    }
    public function getFullInfo() {
        return 'Package : ' . $this->package .
                ' Option :' . $this->packageoption . ' StartDate: ' . $this->startdate->format('M j Y') . ' Adults: ' . $this->adult . ' Kids: ' . $this->kid;
    }

}
