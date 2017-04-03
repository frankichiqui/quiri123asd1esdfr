<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Sale
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\ReservationBundle\Entity\SaleRepository")
 */
class Sale {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")z
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="text",  nullable=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=true)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="orderid", type="string", length=255,  nullable=true)
     */
    private $orderid;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     *  @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Currency")
     *  @ORM\JoinColumn(name="curency", referencedColumnName="id")
     */
    private $currency;

    /**
     *  @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Market")
     *  @ORM\JoinColumn(name="market", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $market;

    /**
     * @var integer
     *
     * @ORM\Column(name="pdf_view", type="integer", options={"default"=0}) 
     */
    private $pdfView;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var string $createdFromIp
     *
     * @Gedmo\IpTraceable(on="create", field={"id", "error", "orderid", "description", "status"})
     * @ORM\Column(length=45, nullable=true)
     */
    private $createdFromIp;

    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="sale",cascade={"all"})
     */
    private $services;

    /**
     *  @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\DUser", inversedBy="sales")
     *  @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set response
     *
     * @param string $response
     *
     * @return Sale
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
     * @return Sale
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
     * @return Sale
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
     * @return Sale
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sale
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Sale
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
        if (!$this->amount) {
            $amount = 0;
            foreach ($this->services as $s) {
                $amount += $s->getCartitem()->getProduct()->getPrice($s->getCartitem(), $this->getMarket());
            }
            if ($this->amount == 0)
                return 0;
            $this->amount = ($amount * $this->currency->getChange()) +
                    (($this->getMarket()->getIncrement() / 100) * $this->currency->getChange() * $amount);
            return $this->amount;
        }
        return $this->amount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sale
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
     * Set orderid
     *
     * @param string $orderid
     *
     * @return Sale
     */
    public function setOrderid($orderid) {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get orderid
     *
     * @return string
     */
    public function getOrderid() {
        return $this->orderid;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Sale
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
     * Get status
     *
     * @return string
     */
    public function getStatusHtml() {


        $salida = '';
        foreach ($this->services as $key => $s) {
            $user = 'Not User';
            if ($s->getStatusByUser()) {
                $user = $s->getStatusByUser()->getUsername();
            }
            $salida .= '<div><small class="label" style="background-color:' . $s->getServicemanagementstatus()->getColor() . ';" >' . $key . '-  ' . $s->getServicemanagementstatus()->getStatus() . ' ( ' . $user . ')</small></div>';
        }
        return $salida;
    }

    public function getHtmlServices() {
        $salida = '';
        foreach ($this->services as $key => $s) {
            $salida .= '<div><small class="label  bg-green" >' . $key . '-' . $s->getCartitem()->getRootFolder() . ' ( ' . $s->getCartitem()->getSpecifications() . ')</small></div>';
        }
        return $salida;
    }

    public function getHtmlIpAndDate() {
        $salida = '';

        $salida .= '<div><small class="label  bg-aqua-active" ><i class="fa fa-calendar"></i> ' . $this->getDate()->format('M j g:i a') . '</small></div>';
        $salida .= '<div><small class="label  bg-aqua-active" ><i class="fa fa-map-marker"></i> ' . $this->createdFromIp . '</small></div>';

        return $salida;
    }

    /**
     * Set pdfView
     *
     * @param integer $pdfView
     *
     * @return Sale
     */
    public function setPdfView($pdfView) {
        $this->pdfView = $pdfView;

        return $this;
    }

    /**
     * Get pdfView
     *
     * @return integer
     */
    public function getPdfView() {
        return $this->pdfView;
    }

    /**
     * Set error
     *
     * @param string $error
     *
     * @return Sale
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Sale
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set createdFromIp
     *
     * @param string $createdFromIp
     *
     * @return Sale
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
     * Add service
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $service
     *
     * @return Sale
     */
    public function addService(\Daiquiri\ReservationBundle\Entity\Service $service) {
        $this->services[] = $service;
        $service->setSale($this);

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $service
     */
    public function removeService(\Daiquiri\ReservationBundle\Entity\Service $service) {
        $this->services->removeElement($service);
        $service->setSale(null);
    }

    public function setServices($services) {

        if (count($services) > 0) {
            foreach ($services as $i) {
                if (!$this->services->contains($i)) {
                    $this->addService($i);
                }
            }
        }

        return $this;
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices() {
        return $this->services;
    }

    /**
     * Set client
     *
     * @param \Daiquiri\AdminBundle\Entity\DUser $client
     *
     * @return Sale
     */
    public function setClient(\Daiquiri\AdminBundle\Entity\DUser $client = null) {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Daiquiri\AdminBundle\Entity\DUser
     */
    public function getClient() {
        return $this->client;
    }

    public function getTotalAmount() {
        $amount = 0;
        if (count($this->services) > 0) {
            foreach ($this->services as $s) {
                $amount += $s->getCartitem()->getTotalprice();
            }
        }
        return $amount;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pdfView = 0;
    }

    public function __toString() {
        return $this->orderid;
    }

    /**
     * Set currency
     *
     * @param \Daiquiri\AdminBundle\Entity\Currency $currency
     *
     * @return Sale
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
     * Set market
     *
     * @param \Daiquiri\AdminBundle\Entity\Market $market
     *
     * @return Sale
     */
    public function setMarket(\Daiquiri\AdminBundle\Entity\Market $market = null) {
        $this->market = $market;

        return $this;
    }

    /**
     * Get market
     *
     * @return \Daiquiri\AdminBundle\Entity\Market
     */
    public function getMarket() {
        return $this->market;
    }

    public function incrementPdfView() {
        $this->setPdfView($this->getPdfView() + 1);
        return $this;
    }

    public function hasServiceWithStatusBySystem() {
        foreach ($this->services as $s) {
            if (strtoupper($s->getServicemanagementstatus()->getStatus()) == "NEW" && ($s->getStatusByUser()->getUsername() == "system")) {
                return true;
            }
        }
        return false;
    }

    public function getAmountInUSD() {
        return $this->amount * $this->currency->getChange();
    }

}
