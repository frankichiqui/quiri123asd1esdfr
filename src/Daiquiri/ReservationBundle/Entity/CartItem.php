<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CartItem
 * 
 * @ORM\Table() 
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"CartItem"="CartItem","CarItem"="CarItem","CircuitItem"="CircuitItem","TransferColectiveItem"="TransferColectiveItem",
 * "TransferExclusiveItem"="TransferExclusiveItem","ExcursionExclusiveItem"="ExcursionExclusiveItem","ExcursionColectiveItem"="ExcursionColectiveItem","OcupationItem"="OcupationItem","PackageOptionItem"="PackageOptionItem", "RentalHouseRoomItem" = "RentalHouseRoomItem","MedicalServiceItem"= "MedicalServiceItem"})
 */
class CartItem {

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * 
     * 
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="realid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cartitem_id_seq", allocationSize=1, initialValue=1)
     */
    protected $realid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var float
     *
     * @ORM\Column(name="unitariprice", type="float")
     */
    protected $unitariprice;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Product", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var float
     *
     * @ORM\Column(name="totalprice", type="float")
     */
    protected $totalprice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime")
     */
    protected $startdate;

    public function __construct() {

        $this->totalprice = 0;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CartItem
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
     * Set unitariprice
     *
     * @param float $unitariprice
     *
     * @return CartItem
     */
    public function setUnitariprice($unitariprice) {
        $this->totalprice = $this->unitariprice * $this->quantity;
        $this->unitariprice = $unitariprice;

        return $this;
    }

    /**
     * Get unitariprice
     *
     * @return float
     */
    public function getUnitariprice() {
        return $this->unitariprice;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CartItem
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->totalprice = $this->unitariprice * $this->quantity;

        return $this;
    }

    public function incrementQuantity() {
        $this->quantity +=1;
        $this->totalprice = $this->unitariprice * $this->quantity;
    }

    public function quantityplus1() {
        $this->quantity +=1;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set totalprice
     *
     * @param float $totalprice
     *
     * @return CartItem
     */
    public function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;

        return $this;
    }

    /**
     * Get totalprice
     *
     * @return float
     */
    public function getTotalprice() {
        return $this->totalprice;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return CartItem
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
     * Get type
     *
     * @return string 
     */
    public function getType() {
        $type = explode('\\', get_class($this));
        return end($type);
    }

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity; $i++) {
            $salida[] = 1;
        }
        return $salida;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return CartItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return CartItem
     */
    public function setProduct(\Daiquiri\AdminBundle\Entity\Product $product = null) {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Daiquiri\AdminBundle\Entity\Product
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * Get realid
     *
     * @return integer
     */
    public function getRealid() {
        return $this->realid;
    }

    public function getRootFolder() {
        return 'Default';
    }

    public function getSpecifications() {
        
    }

}
