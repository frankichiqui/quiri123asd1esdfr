<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CircuitItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CircuitItem extends CartItem {

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
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;

    /**
     * @var integer
     *
     * @ORM\Column(name="ocupation", type="integer")
     */
    private $ocupation;

    /**
     * @var front     
     */
    private $front;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->adults; $i++) {
            $salida[] = 1;
        }
        for ($i = 0; $i < $this->quantity * $this->kids; $i++) {
            $salida[] = 2;
        }
        // dump($salida);die;
        return $salida;
        //return array('adults' => $this->quantity * $this->adults, 'kids' => $this->quantity * $this->kids, 'infants' => 0);
    }

    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product .
                $this->adults .
                $this->kids .
                $this->startdate->format("M j, Y") .
                $this->pickupplace);
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return CircuitItem
     */
    public function setAdults($adults) {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults() {
        return $this->adults;
    }

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return CircuitItem
     */
    public function setKids($kids) {
        $this->kids = $kids;

        return $this;
    }

    /**
     * Get kids
     *
     * @return integer
     */
    public function getKids() {
        return $this->kids;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return CircuitItem
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
     * @return CircuitItem
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

    public function getRootFolder() {
        return 'Circuit';
    }

    public function getSpecifications() {
        return $this->adults . ',' . $this->kids;
    }

    /**
     * Set front
     *
     * @param boolean $front
     *
     * @return CircuitItem
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
     * @return CircuitItem
     */
    public function setRealid($realid) {
        $this->realid = $realid;

        return $this;
    }


    /**
     * Set ocupation
     *
     * @param integer $ocupation
     *
     * @return CircuitItem
     */
    public function setOcupation($ocupation)
    {
        $this->ocupation = $ocupation;

        return $this;
    }

    /**
     * Get ocupation
     *
     * @return integer
     */
    public function getOcupation()
    {
        return $this->ocupation;
    }
}
