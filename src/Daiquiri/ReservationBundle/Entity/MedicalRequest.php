<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * 
 */
class MedicalRequest extends Request {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\MedicalService")
     * @ORM\JoinColumn(name="medicalservice", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $medicalservice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

    public static function getRootViewFolder() {
        return 'Medical';
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CircuitRequest
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

    /**
     * Set medicalservice
     *
     * @param \Daiquiri\AdminBundle\Entity\MedicalService $medicalservice
     *
     * @return MedicalRequest
     */
    public function setMedicalservice(\Daiquiri\AdminBundle\Entity\MedicalService $medicalservice = null) {
        $this->medicalservice = $medicalservice;

        return $this;
    }

    /**
     * Get medicalservice
     *
     * @return \Daiquiri\AdminBundle\Entity\MedicalService
     */
    public function getMedicalservice() {
        return $this->medicalservice;
    }

    public function getFullInfo() {
        return 'SMedical Program: ' . $this->medicalservice->getMedicalProgram() .
                ' Service :' . $this->medicalservice . ' StartDate: ' . $this->startdate->format('M j Y');
    }

}
