<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedicalServiceItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MedicalServiceItem extends CartItem {

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

    public function __construct($title, $unitariprice, $quantity, $product, $startdate) {
        parent::__construct($title, $unitariprice, $quantity, $product, $startdate);

        $this->id = md5($this->title .
                $this->product .
                $this->startdate->format("M j, Y")
        );
    }

    public function getRootFolder() {
        return 'Medical';
    }

}
