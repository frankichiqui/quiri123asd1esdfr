<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"Request"="Request","RentalHouseRequest"="RentalHouseRequest","PackageRequest"="PackageRequest","CircuitRequest"="CircuitRequest","MedicalRequest"="MedicalRequest","TransferExclusiveRequest"="TransferExclusiveRequest","TransferColectiveRequest"="TransferColectiveRequest","CarRequest"="CarRequest","ExcursionRequest"="ExcursionRequest"})
 */
class Request {

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
     * @ORM\Column(name="createAt", type="date")
     */
    private $createAt;

    /**
     * @var string
     *
     * @ORM\Column(name="paxname", type="string", length=255)
     */
    private $paxname;

    /**
     * @var string
     *
     * @ORM\Column(name="paxlastname", type="string", length=255)
     */
    private $paxlastname;

    /**
     * @var string
     *
     * @ORM\Column(name="paxemail", type="string", length=255)
     */
    private $paxemail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ipclient", type="string", length=255)
     */
    private $ipclient;

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
     * @var string
     *
     * @ORM\Column(name="captcha", type="string", length=255)
     */
    private $captcha;

    /**
     * @var string
     *
     * @ORM\Column(name="sendclientrequest", type="boolean", options={"dafault"=false})
     */
    private $sendclientrequest;

    /**
     * @var string
     *
     * @ORM\Column(name="sendagentrequest", type="boolean", options={"dafault"=false})
     */
    private $sendagentrequest;

    /**
     * @var string
     * @ORM\Column(name="remarks", type="string", length=2000, nullable=true)
     */
    private $remarks;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Request
     */
    public function setCreateAt($createAt) {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt() {
        return $this->createAt;
    }

    /**
     * Set paxname
     *
     * @param string $paxname
     *
     * @return Request
     */
    public function setPaxname($paxname) {
        $this->paxname = $paxname;

        return $this;
    }

    /**
     * Get paxname
     *
     * @return string
     */
    public function getPaxname() {
        return $this->paxname;
    }

    /**
     * Set paxlastname
     *
     * @param string $paxlastname
     *
     * @return Request
     */
    public function setPaxlastname($paxlastname) {
        $this->paxlastname = $paxlastname;

        return $this;
    }

    /**
     * Get paxlastname
     *
     * @return string
     */
    public function getPaxlastname() {
        return $this->paxlastname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Request
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

    /**
     * Set captcha
     *
     * @param string $captcha
     *
     * @return Request
     */
    public function setCaptcha($captcha) {
        $this->captcha = $captcha;

        return $this;
    }

    /**
     * Get captcha
     *
     * @return string
     */
    public function getCaptcha() {
        return $this->captcha;
    }

    /**
     * Set paxemail
     *
     * @param string $paxemail
     *
     * @return Request
     */
    public function setPaxemail($paxemail) {
        $this->paxemail = $paxemail;

        return $this;
    }

    /**
     * Get paxemail
     *
     * @return string
     */
    public function getPaxemail() {
        return $this->paxemail;
    }

    /**
     * Set gender
     *
     * @param \Daiquiri\ReservationBundle\Entity\Gender $gender
     *
     * @return Request
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

    public function getCartitem() {
        $cart = new RentalHouseRoomItem();
        return $cart;
    }

    public function getFullClientName() {
        return $this->paxname . ' ' . $this->paxlastname;
    }

    /**
     * Set ipclient
     *
     * @param string $ipclient
     *
     * @return Request
     */
    public function setIpclient($ipclient) {
        $this->ipclient = $ipclient;

        return $this;
    }

    /**
     * Get ipclient
     *
     * @return string
     */
    public function getIpclient() {
        return $this->ipclient;
    }

    public function getPaxage() {
        return $this->birthdate->diff(new \DateTime('today'))->y;
    }

    public static function getRootViewFolder() {
        return 'Default';
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Request
     */
    public function setRemarks($remarks) {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks() {
        return $this->remarks;
    }

    public function getFullInfo() {
        
    }

    /**
     * Set sendclientrequest
     *
     * @param boolean $sendclientrequest
     *
     * @return Request
     */
    public function setSendclientrequest($sendclientrequest) {
        $this->sendclientrequest = $sendclientrequest;

        return $this;
    }

    /**
     * Get sendclientrequest
     *
     * @return boolean
     */
    public function getSendclientrequest() {
        return $this->sendclientrequest;
    }

    /**
     * Set sendagentrequest
     *
     * @param boolean $sendagentrequest
     *
     * @return Request
     */
    public function setSendagentrequest($sendagentrequest) {
        $this->sendagentrequest = $sendagentrequest;

        return $this;
    }

    /**
     * Get sendagentrequest
     *
     * @return boolean
     */
    public function getSendagentrequest() {
        return $this->sendagentrequest;
    }

}
