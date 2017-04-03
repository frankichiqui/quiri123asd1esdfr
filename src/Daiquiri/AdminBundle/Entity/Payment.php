<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\PaymentRepository")
 */
class Payment {

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
     * @ORM\Column(name="error", type="text", nullable=true)
     */
    private $error;

    /**
     * @var string
     *
     * @ORM\Column(name="response", type="string", length=255, nullable=true)
     */
    private $response;

    /**
     * @var string
     *
     * @ORM\Column(name="card_country", type="string", length=255, nullable=true)
     */
    private $cardCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_code", type="string", length=255, nullable=true)
     */
    private $authCode;

    /**
     * @var string
     *
     * @ORM\Column(name="card_type", type="string", length=255, nullable=true)
     */
    private $cardType;

   

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="order_id", type="string", length=255, nullable=true)
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string $createdFromIp
     *
     * @Gedmo\IpTraceable(on="create")
     * @ORM\Column(length=45, nullable=true)
     */
    private $createdFromIp;

    /**
     *  @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Currency")
     *  @ORM\JoinColumn(name="curency", referencedColumnName="id")
     */
    private $currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="pdfview", type="integer", options={"default"=0})
     */
    private $pdfview;

    /**
     *  @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\DUser", inversedBy="sales")
     *  @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var \DateTime $dateCreated
     *
     * @ORM\Column(name="date_created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $dateCreated;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set error
     *
     * @param string $error
     *
     * @return Payment
     */
    public function setError($error) {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError() {
        return $this->error;
    }

    /**
     * Set response
     *
     * @param string $response
     *
     * @return Payment
     */
    public function setResponse($response) {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Set cardCountry
     *
     * @param string $cardCountry
     *
     * @return Payment
     */
    public function setCardCountry($cardCountry) {
        $this->cardCountry = $cardCountry;

        return $this;
    }

    /**
     * Get cardCountry
     *
     * @return string
     */
    public function getCardCountry() {
        return $this->cardCountry;
    }

    /**
     * Set authCode
     *
     * @param string $authCode
     *
     * @return Payment
     */
    public function setAuthCode($authCode) {
        $this->authCode = $authCode;

        return $this;
    }

    /**
     * Get authCode
     *
     * @return string
     */
    public function getAuthCode() {
        return $this->authCode;
    }

    /**
     * Set cardType
     *
     * @param string $cardType
     *
     * @return Payment
     */
    public function setCardType($cardType) {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * Get cardType
     *
     * @return string
     */
    public function getCardType() {
        return $this->cardType;
    }

   

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Payment
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set createdFromIp
     *
     * @param string $createdFromIp
     *
     * @return Payment
     */
    public function setCreatedFromIp($createdFromIp) {
        $this->createdFromIp = $createdFromIp;

        return $this;
    }

    /**
     * Get createdFromIp
     *
     * @return string
     */
    public function getCreatedFromIp() {
        return $this->createdFromIp;
    }

    /**
     * Set pdfview
     *
     * @param integer $pdfview
     *
     * @return Payment  
     */
    public function setPdfview($pdfview) {
        $this->pdfview = $pdfview;

        return $this;
    }

    /**
     * Get pdfview
     *
     * @return integer
     */
    public function getPdfview() {
        return $this->pdfview;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Payment
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * Set orderId
     *
     * @param string $orderId
     *
     * @return Payment
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return string
     */
    public function getOrderId() {
        return $this->orderId;
    }

    public function __toString() {
        return ($this->getOrderId()) ? : '';
    }

    

    /**
     * Set currency
     *
     * @param \Daiquiri\AdminBundle\Entity\Currency $currency
     *
     * @return Payment
     */
    public function setCurrency(\Daiquiri\AdminBundle\Entity\Currency $currency = null) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Daiquiri\AdminBundle\Entity\Currency
     */
    public function getCurrency() {
        return $this->currency;
    }


    /**
     * Set client
     *
     * @param \Daiquiri\AdminBundle\Entity\DUser $client
     *
     * @return Payment
     */
    public function setClient(\Daiquiri\AdminBundle\Entity\DUser $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Daiquiri\AdminBundle\Entity\DUser
     */
    public function getClient()
    {
        return $this->client;
    }
}
