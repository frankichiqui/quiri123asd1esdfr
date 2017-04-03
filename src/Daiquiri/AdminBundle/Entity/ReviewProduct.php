<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ReviewProduct extends Review {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="reviews")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * Set product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return Review
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

}
