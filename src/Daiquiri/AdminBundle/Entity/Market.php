<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Market
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\MarketRepository")
 */
class Market {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Country", mappedBy="market")
     */
    private $countries;

    /**
     * @var float
     *
     * @ORM\Column(name="increment", type="float")
     */
    private $increment;

   

    /**
     * @ORM\ManyToMany(targetEntity="Campaign", mappedBy="markets")
     */
    private $campaigns;

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Market
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
     * @return Market
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
     * @return Market
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
     * Set increment
     *
     * @param float $increment
     *
     * @return Market
     */
    public function setIncrement($increment) {
        $this->increment = $increment;

        return $this;
    }

    /**
     * Get increment
     *
     * @return float
     */
    public function getIncrement() {
        return $this->increment;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add country
     *
     * @param \Daiquiri\AdminBundle\Entity\Country $country
     *
     * @return Market
     */
    public function addCountry(\Daiquiri\AdminBundle\Entity\Country $country) {
        $country->setMarket($this);
        $this->countries[] = $country;

        return $this;
    }

    /**
     * Remove country
     *
     * @param \Daiquiri\AdminBundle\Entity\Country $country
     */
    public function removeCountry(\Daiquiri\AdminBundle\Entity\Country $country) {
        $country->setMarket(null);
        $this->countries->removeElement($country);
    }

    public function setCountries($countries) {
        if (count($countries) > 0) {
            foreach ($countries as $c) {
                $this->addCountry($c);
            }
        }
        return $this;
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries() {
        return $this->countries;
    }

    public function hasCountryByCode($code) {
        if (count($this->countries) > 0) {
            foreach ($this->countries as $country) {
                if ($country->getIsoCode() == $code) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getCountryByCode($code) {
        if (count($this->countries) > 0) {
            foreach ($this->countries as $country) {
                if ($country->getIsoCode() == $code) {
                    return $country;
                }
            }
        }
        return null;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\Campaign $campaign
     *
     * @return Market
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\Campaign $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\Campaigns $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\Campaign $campaign) {
        $this->campaigns->removeElement($campaign);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampaigns() {
        return $this->campaigns;
    }

}
