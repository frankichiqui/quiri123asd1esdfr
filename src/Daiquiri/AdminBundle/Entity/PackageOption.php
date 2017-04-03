<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PackageOption
 *
 * @ORM\Table(name="package_option")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\PackageOptionRepository")
 */
class PackageOption extends Product {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="include", type="string", length=2000, nullable=true)
     */
    private $include;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="notinclude", type="string", length=2000, nullable=true)
     */
    private $notinclude;

    /**
     * @var float
     *
     * @ORM\Column(name="priceadult", type="float", precision=10, scale=0, nullable=true)
     */
    private $priceadult;

    /**
     * @var float
     *
     * @ORM\Column(name="pricekid", type="float", precision=10, scale=0, nullable=true)
     */
    private $pricekid;

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer", nullable=true)
     */
    private $days;

    /**
     * @var integer
     *
     * @ORM\Column(name="nigths", type="integer", nullable=true)
     */
    private $nigths;

    /**
     * @var \Daiquiri\AdminBundle\Entity\Package
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Package", inversedBy="package_options", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_package", referencedColumnName="id")
     * })
     */
    private $package;

    /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Polo", inversedBy="package_options")
     * @ORM\JoinTable(name="package_option_polos")
     */
    private $polos;

    /**
     * @ORM\OneToMany(targetEntity="CampaignPackage", mappedBy="package", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    private $campaigns;

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignPackage $campaign
     *
     * @return PackageOption
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\CampaignPackage $campaign) {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\CampaignExcursion $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\CampaignPackage $campaign) {
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

    public function __construct() {
        $this->polos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function titleandpackage() {
        if ($this->package) {
            return $this->package->getTitle() . ' ' . $this;
        }
        return $this . ' ';
    }

    /**
     * Set include
     *
     * @param string $include
     *
     * @return PackageOption
     */
    public function setInclude($include) {
        $this->include = $include;

        return $this;
    }

    /**
     * Get include
     *
     * @return string
     */
    public function getInclude() {
        return $this->include;
    }

    /**
     * Set notinclude
     *
     * @param string $notinclude
     *
     * @return PackageOption
     */
    public function setNotinclude($notinclude) {
        $this->notinclude = $notinclude;

        return $this;
    }

    /**
     * Get notinclude
     *
     * @return string
     */
    public function getNotinclude() {
        return $this->notinclude;
    }

    /**
     * Set package
     *
     * @param \Daiquiri\AdminBundle\Entity\Package $package
     *
     * @return PackageOption
     */
    public function setPackage(\Daiquiri\AdminBundle\Entity\Package $package = null) {

        $this->package = $package;


        return $this;
    }

    /**
     * Get package
     *
     * @return \Daiquiri\AdminBundle\Entity\Package
     */
    public function getPackage() {
        return $this->package;
    }

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return PackageOption
     */
    public function setDays($days) {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays() {
        return $this->days;
    }

    /**
     * Set nigths
     *
     * @param integer $nigths
     *
     * @return PackageOption
     */
    public function setNigths($nigths) {
        $this->nigths = $nigths;

        return $this;
    }

    /**
     * Get nigths
     *
     * @return integer
     */
    public function getNigths() {
        return $this->nigths;
    }

    /**
     * Add polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     *
     * @return PackageOption
     */
    public function addPolo(\Daiquiri\AdminBundle\Entity\Polo $polo) {
        $this->polos[] = $polo;

        return $this;
    }

    /**
     * Remove polo
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $polo
     */
    public function removePolo(\Daiquiri\AdminBundle\Entity\Polo $polo) {
        $this->polos->removeElement($polo);
    }

    /**
     * Get polos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPolos() {
        return $this->polos;
    }

    public function containPolo(Polo $polo) {
        if (count($this->polos) > 0) {
            foreach ($this->polos as $p) {
                if ($polo->getId() == $p->getId()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function containMultiplePolos(\Doctrine\Common\Collections\ArrayCollection $polos) {
        if (count($polos) > 0) {
            foreach ($polos as $p) {
                if (!$this->containPolo($p)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getTotalPrice($adults, $kids, $infants) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        return (($adults + $kids + $infants) * $this->price) * (1 + $increment);
    }

    public $current_offert;

    public function getCampaignForDate(\DateTime $date, Market $market) {
        foreach ($this->campaigns as $c) {
            if ($c->getStartdate() <= $date && $c->getEnddate() >= $date && $c->getMarkets()->contains($market)) {
                return $c;
            }
        }
        return null;
    }

    public function getPrice(\Daiquiri\ReservationBundle\Entity\PackageOptionItem $item = null, Market $market) {
        $increment = 0;
        if ($this->getProductIncrement()) {
            $increment = $this->getProductIncrement()->getIncrement();
        }
        if (!$item) {
            return $this->priceadult * (1 + $increment);
        }
        $c = $this->getCampaignForDate($item->getStartdate(), $market);
        if ($c) {
            return (($item->getAdults() * ($this->priceadult - $c->getAdultdicount())) + ($item->getKids() * ($this->pricekid - $c->getKiddicount()))) * (1 + $increment);
        }
        return (($item->getAdults() * $this->priceadult + $item->getKids()) * $this->pricekid) * (1 + $increment);
    }

    /**
     * Set priceadult
     *
     * @param float $priceadult
     *
     * @return PackageOption
     */
    public function setPriceadult($priceadult) {
        $this->priceadult = $priceadult;

        return $this;
    }

    /**
     * Get priceadult
     *
     * @return float
     */
    public function getPriceadult() {
        return $this->priceadult;
    }

    /**
     * Set pricekid
     *
     * @param float $pricekid
     *
     * @return PackageOption
     */
    public function setPricekid($pricekid) {
        $this->pricekid = $pricekid;

        return $this;
    }

    /**
     * Get pricekid
     *
     * @return float
     */
    public function getPricekid() {
        return $this->pricekid;
    }

    /**
     * Add review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     *
     * @return Package
     */
    public function addReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        if ($this->package)
            $this->package->getReviews()->add($review);

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     */
    public function removeReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        if ($this->package)
            $this->package->getReviews()->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews() {
        if ($this->package)
            return $this->package->getReviews();
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Package
     */
    public function setAvailable($available) {
        if ($this->package)
            $this->package->setAvailable($available);

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable() {
        if ($this->package)
            return $this->package->getAvailable();
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Package
     */
    public function setPriority($priority) {
        if ($this->package)
            $this->package->setPriority($priority);

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority() {
        if ($this->package)
            return $this->package->getPriority();
    }

    /**
     * Set payonline
     *
     * @param boolean $payonline
     *
     * @return Package
     */
    public function setPayonline($payonline) {
        if ($this->package)
            $this->package->setPayonline($payonline);

        return $this;
    }

    /**
     * Get payonline
     *
     * @return boolean
     */
    public function getPayonline() {
        if ($this->package)
            return $this->package->getPayonline();
    }

  

   

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Package
     */
    public function setRemarks($remarks) {
        if ($this->package)
            $this->package->setRemarks($remarks);

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks() {
        if ($this->package)
            return $this->package->getRemarks();
    }

    /**
     * Set termConditionHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse
     *
     * @return Package
     */
    public function setTermConditionHouse(\Daiquiri\AdminBundle\Entity\TermConditionProduct $termConditionHouse = null) {
        if ($this->package)
            $this->package->setTermConditionHouse($termConditionHouse);

        return $this;
    }

    /**
     * Get termConditionHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\TermConditionProduct
     */
    public function getTermConditionHouse() {
        if ($this->package)
            return $this->package->getTermConditionHouse();
    }

    /**
     * Set cancelationHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse
     *
     * @return Package
     */
    public function setCancelationHouse(\Daiquiri\AdminBundle\Entity\CancelationProduct $cancelationHouse = null) {
        if ($this->package)
            $this->package->setCancelationHouse($cancelationHouse);

        return $this;
    }

    /**
     * Get cancelationHouse
     *
     * @return \Daiquiri\AdminBundle\Entity\CancelationProduct
     */
    public function getCancelationHouse() {
        if ($this->package)
            return $this->package->getCancelationHouse();
    }

    /**
     * Add document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     *
     * @return Package
     */
    public function addDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        if ($this->package)
            $this->package->addDocument($document);

        return $this;
    }

    /**
     * Remove document
     *
     * @param \Daiquiri\AdminBundle\Entity\Document $document
     */
    public function removeDocument(\Daiquiri\AdminBundle\Entity\Document $document) {
        if ($this->package)
            $this->package->removeDocument($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments() {
        if ($this->package)
            return $this->package->getDocuments();
    }

    public function setProductIncrement(\Daiquiri\AdminBundle\Entity\ProductIncrement $productIncrement = null) {
        if ($this->package) {
            $this->package->setProductIncrement($productIncrement);
        }

        return $this;
    }

    public function getProductIncrement() {
        if ($this->package) {
            return $this->package->getProductIncrement();
        }
        return null;
    }

}
