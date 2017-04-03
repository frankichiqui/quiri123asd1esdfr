<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCategory
 *
 * @ORM\Table(name="product_category", indexes={@ORM\Index(name="IDX_CDFC7356D34A04AD", columns={"product"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ProductCategoryRepository")
 */
class ProductCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_category_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Product", inversedBy="product_category", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id")
     * })
     */
    private $product;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ProductCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set product
     *
     * @param \Daiquiri\AdminBundle\Entity\Product $product
     *
     * @return ProductCategory
     */
    public function setProduct(\Daiquiri\AdminBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Daiquiri\AdminBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
