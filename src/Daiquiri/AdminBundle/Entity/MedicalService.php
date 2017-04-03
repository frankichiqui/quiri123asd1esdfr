<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * MedicalService
 *
 * @ORM\Table(name="medical_service", indexes={@ORM\Index(name="IDX_A79F7A1CD4EF974A", columns={"medical_program"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\MedicalServiceRepository")
 */
class MedicalService extends Product {

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
     * @ORM\Column(name="research", type="string", length=2000, nullable=true)
     */
    private $research;

    /**
     * @var string
     *
     * @ORM\Column(name="consultations", type="string", length=2000, nullable=true)
     */
    private $consultations;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var \Daiquiri\AdminBundle\Entity\MedicalProgram
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\MedicalProgram", inversedBy="medical_services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medical_program", referencedColumnName="id")
     * })
     */
    private $medicalProgram;

    /**
     * @ORM\OneToMany(targetEntity="CampaignMedical", mappedBy="medical")
     */
    private $campaigns;

    /**
     * Set research
     *
     * @param string $research
     *
     * @return MedicalService
     */
    public function setResearch($research) {
        $this->research = $research;

        return $this;
    }

    /**
     * Get research
     *
     * @return string
     */
    public function getResearch() {
        return $this->research;
    }

    /**
     * Set consultations
     *
     * @param string $consultations
     *
     * @return MedicalService
     */
    public function setConsultations($consultations) {
        $this->consultations = $consultations;

        return $this;
    }

    /**
     * Get consultations
     *
     * @return string
     */
    public function getConsultations() {
        return $this->consultations;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return MedicalService
     */
    public function setDay($day) {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return MedicalService
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {

        return $this->price;
    }

    /**
     * Set medicalProgram
     *
     * @param \Daiquiri\AdminBundle\Entity\MedicalProgram $medicalProgram
     *
     * @return MedicalService
     */
    public function setMedicalProgram(\Daiquiri\AdminBundle\Entity\MedicalProgram $medicalProgram = null) {
        $this->medicalProgram = $medicalProgram;

        return $this;
    }

    /**
     * Get medicalProgram
     *
     * @return \Daiquiri\AdminBundle\Entity\MedicalProgram
     */
    public function getMedicalProgram() {
        return $this->medicalProgram;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignMedical $campaign
     *
     * @return MedicalService
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignMedical $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignMedical $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignMedical $campaign) {
        $this->campaigns->removeElement($campaign);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampaigns() {
        return $this->campaigns;
    }

    public function __construct() {
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getFromprice() {
        return $this->getPrice();
    }

}
