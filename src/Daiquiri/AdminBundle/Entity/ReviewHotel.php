<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ReviewHotel extends Review {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="reviews")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * Set hotel
     *
     * @param \Daiquiri\AdminBundle\Entity\Hotel $hotel
     *
     * @return Review
     */
    public function setHotel(\Daiquiri\AdminBundle\Entity\Hotel $hotel = null) {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Daiquiri\AdminBundle\Entity\Hotel
     */
    public function getHotel() {
        return $this->hotel;
    }

}
