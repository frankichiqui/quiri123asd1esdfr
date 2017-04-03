<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageOptionItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PackageOptionItem extends CartItem {

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
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="infant", type="integer")
     */
    private $infants;

    public function getArrayPaxs() {
        $salida = array();
        for ($i = 0; $i < $this->quantity * $this->adults; $i++) {
            $salida[] = 1;
        }
        for ($i = 0; $i < $this->quantity * $this->kids; $i++) {
            $salida[] = 2;
        }
        for ($i = 0; $i < $this->quantity * $this->infants; $i++) {
            $salida[] = 3;
        }
        return $salida;
        //return array('adults' => $this->quantity * $this->adults, 'kids' => $this->quantity * $this->kids, 'infants' => $this->quantity * $this->infants);
    }

    

    /**
     * Set pickupplace
     *
     * @param integer $pickupplace
     *
     * @return PackageOptionItem
     */
    public function setPickupplace($pickupplace) {
        $this->pickupplace = $pickupplace;

        return $this;
    }

    /**
     * Get pickupplace
     *
     * @return integer
     */
    public function getPickupplace() {
        return $this->pickupplace;
    }

    public function GenerateId() {
        $this->id = md5($this->title .
                $this->product .
                $this->adults .
                $this->kids .
                $this->infants .
                $this->startdate->format('M j, Y') .
                $this->pickupplace);
    }

    public function __construct() {
        parent::__construct();
    }

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return PackageOptionItem
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
     * Set adults
     *
     * @param integer $adults
     *
     * @return PackageOptionItem
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
     * Set infants
     *
     * @param integer $infants
     *
     * @return PackageOptionItem
     */
    public function setInfants($infants) {
        $this->infants = $infants;

        return $this;
    }

    /**
     * Get infants
     *
     * @return integer
     */
    public function getInfants() {
        return $this->infants;
    }


    /**
     * Set id
     *
     * @param string $id
     *
     * @return PackageOptionItem
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
     public function getRootFolder() {
        return 'Package';
    }
    public function getSpecifications() {
        return  $this->adults . ',' . $this->kids;
    }
}
