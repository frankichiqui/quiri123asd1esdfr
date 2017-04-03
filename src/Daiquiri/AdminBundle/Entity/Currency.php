<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Currency
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\CurrencyRepository")
 */
class Currency {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="currency_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="change", type="float", precision=10, scale=0, nullable=true)
     */
    private $change;

    /**
     * @var string
     *
     * @ORM\Column(name="nomenclator", type="string", length=255, nullable=true)
     */
    private $nomenclator;

    /**
     * @var string
     *
     * @ORM\Column(name="favicon", type="string", length=255, nullable=true)
     */
    private $favicon;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"id", "title"})
     */
    private $uniqueSlug;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Currency
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set change
     *
     * @param float $change
     *
     * @return Currency
     */
    public function setChange($change) {
        $this->change = $change;

        return $this;
    }

    /**
     * Get change
     *
     * @return float
     */
    public function getChange() {
        return $this->change;
    }

    /**
     * Set nomenclator
     *
     * @param string $nomenclator
     *
     * @return Currency
     */
    public function setNomenclator($nomenclator) {
        $this->nomenclator = $nomenclator;

        return $this;
    }

    /**
     * Get nomenclator
     *
     * @return string
     */
    public function getNomenclator() {
        return $this->nomenclator;
    }

    /**
     * Set favicon
     *
     * @param string $favicon
     *
     * @return Currency
     */
    public function setFavicon($favicon) {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string
     */
    public function getFavicon() {
        return $this->favicon;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Currency
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return Currency
     */
    public function setUniqueSlug($uniqueSlug) {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug() {
        return $this->uniqueSlug;
    }

    public function __toString() {
        return ($this->getTitle()) ? : '';
    }


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
