<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Airline
 *
 * @ORM\Table(name="block")
 * @ORM\Entity()
 */
class Block {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="airline_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="mincampaign", type="integer")
     */
    private $mincampaign;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="Campaign", mappedBy="block")
     */
    private $campaigns;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true, options={"default"=0})
     */
    private $number;

    /**
     * Constructor
     */
    public function __construct() {
        $this->campaigns = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Block
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
     * Set mincampaign
     *
     * @param integer $mincampaign
     *
     * @return Block
     */
    public function setMincampaign($mincampaign) {
        $this->mincampaign = $mincampaign;

        return $this;
    }

    /**
     * Get mincampaign
     *
     * @return integer
     */
    public function getMincampaign() {
        return $this->mincampaign;
    }

    /**
     * Add campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\Campaign $campaign
     *
     * @return Block
     */
    public function addCampaign(\Daiquiri\AdminBundle\Entity\Campaign $campaign) {
        $campaign->setBlock($this);
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Daiquiri\AdminBundle\Entity\Campaign $campaign
     */
    public function removeCampaign(\Daiquiri\AdminBundle\Entity\Campaign $campaign) {
        $campaign->setBlock();
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

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Block
     */
    public function setVisible($visible) {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return \boolean
     */
    public function getVisible() {
        return $this->visible;
    }

    public function __toString() {
        if ($this->getTitle()) {
            return $this->title . ' min-' . $this->mincampaign;
        }
        return '';
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Block
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber() {
        return $this->number;
    }

}
