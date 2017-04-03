<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductSeo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ProductSeoRepository")
 */
class ProductSeo {

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
     * @ORM\Column(name="keywords", type="string", length=255)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="productType", type="string", length=255)
     */
    private $productType;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     *
     * @return ProductSeo
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProductSeo
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set productType
     *
     * @param string $productType
     *
     * @return ProductSeo
     */
    public function setProductType($productType) {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return string
     */
    public function getProductType() {
        return $this->productType;
    }

    public function __toString() {
        return ($this->getProductType()) ? : '';
    }

}
