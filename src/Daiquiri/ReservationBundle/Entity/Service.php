<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Service {

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
     * @ORM\Column(name="confirmationcode", type="string", length=255, nullable=true)
     */
    private $confirmationcode;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="string", length=2000, nullable=true)
     */
    private $remark;

    /**
     * @var \Daiquiri\ReservationBundle\Entity\Sale
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\ReservationBundle\Entity\Sale", inversedBy="services", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale", referencedColumnName="id")
     * })
     */
    private $sale;

    /**
     * @var \Daiquiri\ReservationBundle\Entity\ServiceManagementStatus
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\ReservationBundle\Entity\ServiceManagementStatus", inversedBy="services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicemanagementstatus", referencedColumnName="id")
     * })
     */
    private $servicemanagementstatus;

    /**
     * *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\DUser", inversedBy="status_services")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * 
     */
    private $status_by_user;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\ServicePax", mappedBy="service",cascade={"all"})
     */
    private $servicepaxs;

    /**
     * @ORM\OneToOne(targetEntity="CartItem", cascade={"all"})
     * @ORM\JoinColumn(name="cartitem", referencedColumnName="realid")
     */
    private $cartitem;

    public function __toString() {
        return $this->sale->getOrderid() . " - " . $this->getId();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set confirmationcode
     *
     * @param string $confirmationcode
     *
     * @return Service
     */
    public function setConfirmationcode($confirmationcode) {
        $this->confirmationcode = $confirmationcode;

        return $this;
    }

    /**
     * Get confirmationcode
     *
     * @return string
     */
    public function getConfirmationcode() {
        return $this->confirmationcode;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->servicepaxs = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    public function setStatusByUser($user) {
        $this->status_by_user = $user;
        return $this;

        
    }

    /**
     * Set sale
     *
     * @param \Daiquiri\ReservationBundle\Entity\Sale $sale
     *
     * @return Service
     */
    public function setSale(\Daiquiri\ReservationBundle\Entity\Sale $sale = null) {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \Daiquiri\ReservationBundle\Entity\Sale
     */
    public function getSale() {
        return $this->sale;
    }

    /**
     * Add servicepax
     *
     * @param \Daiquiri\ReservationBundle\Entity\ServicePax $servicepax
     *
     * @return Service
     */
    public function addServicepax(\Daiquiri\ReservationBundle\Entity\ServicePax $servicepax) {
        $this->servicepaxs[] = $servicepax;
        $servicepax->setService($this);

        return $this;
    }

    /**
     * Remove servicepax
     *
     * @param \Daiquiri\ReservationBundle\Entity\ServicePax $servicepax
     */
    public function removeServicepax(\Daiquiri\ReservationBundle\Entity\ServicePax $servicepax) {
        $this->servicepaxs->removeElement($servicepax);
        $servicepax->setService(null);
    }

    public function setServicepaxs($servicepaxs) {
        if (count($servicepaxs) > 0) {
            foreach ($servicepaxs as $i) {
                $this->addServicepax($i);
            }
        }
        return $this;
    }

    /**
     * Get servicepaxs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServicepaxs() {
        return $this->servicepaxs;
    }

    /**
     * Set cartitem
     *
     * @param \Daiquiri\ReservationBundle\Entity\CartItem $cartitem
     *
     * @return Service
     */
    public function setCartitem(\Daiquiri\ReservationBundle\Entity\CartItem $cartitem = null) {
        $this->cartitem = $cartitem;

        return $this;
    }

    /**
     * Get cartitem
     *
     * @return \Daiquiri\ReservationBundle\Entity\CartItem
     */
    public function getCartitem() {
        return $this->cartitem;
    }

    /**
     * Set servicemanagementstatus
     *
     * @param \Daiquiri\ReservationBundle\Entity\ServiceManagementStatus $servicemanagementstatus
     *
     * @return Service
     */
    public function setServicemanagementstatus(\Daiquiri\ReservationBundle\Entity\ServiceManagementStatus $servicemanagementstatus = null) {
        $this->servicemanagementstatus = $servicemanagementstatus;

        return $this;
    }

    /**
     * Get servicemanagementstatus
     *
     * @return \Daiquiri\ReservationBundle\Entity\ServiceManagementStatus
     */
    public function getServicemanagementstatus() {
        return $this->servicemanagementstatus;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return Service
     */
    public function setRemark($remark) {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark() {
        return $this->remark;
    }




    public function getAmount() {
        return ($this->cartitem->getPrice($this->cartitem));

    }

   
  


    /**
     * Get statusByUser
     *
     * @return \Daiquiri\AdminBundle\Entity\DUser
     */
    public function getStatusByUser()
    {
        return $this->status_by_user;
    }
}
