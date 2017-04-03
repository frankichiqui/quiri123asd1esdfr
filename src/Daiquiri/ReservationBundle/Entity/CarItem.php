<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CarItem extends CartItem {

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
     * 
     */
    protected $realid;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="pickupplace_id", referencedColumnName="id")
     */
    private $pickupplace;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place")
     * @ORM\JoinColumn(name="dropoffplace_id", referencedColumnName="id")
     */
    private $dropoffplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime")
     */
    private $enddate;

    /**
     * @var front     
     */
    private $front;

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return CarItem
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate() {
        return $this->enddate;
    }

    //metodo para identicar un elemento a un carrito
    public function GenerateId() {
        $this->id = md5($this->title .
                        $this->startdate->format('M j, Y') .
                        $this->enddate->format('M j, Y')) .
                $this->product->getId();
    }

    public function getDiffDays() {
        $interval = $this->startdate->diff($this->enddate);
        return $interval->format('%d');
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return CarItem
     */
    public function setPickupplace(\Daiquiri\AdminBundle\Entity\Place $pickupplace = null) {
        $this->pickupplace = $pickupplace;

        return $this;
    }

    /**
     * Get pickupplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getPickupplace() {
        return $this->pickupplace;
    }

    /**
     * Set dropoffplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $dropoffplace
     *
     * @return CarItem
     */
    public function setDropoffplace(\Daiquiri\AdminBundle\Entity\Place $dropoffplace = null) {
        $this->dropoffplace = $dropoffplace;

        return $this;
    }

    /**
     * Get dropoffplace
     *
     * @return \Daiquiri\AdminBundle\Entity\Place
     */
    public function getDropoffplace() {
        return $this->dropoffplace;
    }

    public function getRootFolder() {
        return 'Car';
    }

    public function getSpecifications() {
        return '';
    }

    /**
     * Set realid
     *
     * @param integer $realid
     *
     * @return CarItem
     */
    public function setRealid($realid) {
        $this->realid = $realid;

        return $this;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return CarItem
     */
    public function setFront($front) {
        $this->front = $front;

        return $this;
    }

    /**
     * Get front
     *
     * @return boolean
     */
    public function getFront() {
        return $this->front;
    }

}
