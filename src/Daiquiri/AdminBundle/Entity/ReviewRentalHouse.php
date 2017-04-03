<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ReviewRentalHouse extends Review {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="RentalHouse", inversedBy="reviews")
     * @ORM\JoinColumn(name="rentalhouse_id", referencedColumnName="id")
     */
    private $rentalhouse;

    /**
     * Set rentalhouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse
     *
     * @return ReviewRentalHouse
     */
    public function setRentalhouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalhouse = null) {
        $this->rentalhouse = $rentalhouse;

        return $this;
    }

    /**
     * Get rentalhouse
     *
     * @return \Daiquiri\AdminBundle\Entity\RentalHouse
     */
    public function getRentalhouse() {
        return $this->rentalhouse;
    }

}
