<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExcursionColectiveItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ExcursionColectiveItem extends CartItem {

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
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="pickupplace", referencedColumnName="id")
     */
    private $pickupplace;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Place", cascade={"persist","refresh","merge","detach"})
     * @ORM\JoinColumn(name="dropoffplace", referencedColumnName="id")
     */
    private $dropoffplace;

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
     * @var front     
     */
    private $front;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->adult; $i++) {
            $salida[] = 1;
        }
        for ($i = 0; $i < $this->quantity * $this->kid; $i++) {
            $salida[] = 2;
        }
        return $salida;
        //return array('adults' => $this->quantity * $this->adults, 'kids' => $this->quantity * $this->kids, 'infants' => 0);
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
     * Set adult
     *
     * @param integer $adult
     *
     * @return ExcursionColectiveItem
     */
    public function setAdult($adult) {
        $this->adult = $adult;

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
     * Set kid
     *
     * @param integer $kid
     *
     * @return ExcursionColectiveItem
     */
    public function setKid($kid) {
        $this->kid = $kid;

        return $this;
    }

    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product .
                $this->startdate->format("M j, Y") .
                $this->pickupplace);
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return ExcursionColectiveItem
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Set pickupplace
     *
     * @param \Daiquiri\AdminBundle\Entity\Place $pickupplace
     *
     * @return ExcursionColectiveItem
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
     * @return ExcursionColectiveItem
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
        return 'Excursion';
    }

    public function getSpecifications() {
        return 'Colective ' . $this->adult . ',' . $this->kid;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return ExcursionColectiveItem
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


    /**
     * Set realid
     *
     * @param integer $realid
     *
     * @return ExcursionColectiveItem
     */
    public function setRealid($realid)
    {
        $this->realid = $realid;

        return $this;
    }
}
