<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ReviewRepository")* @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"ReviewHotel"="ReviewHotel","ReviewRentalHouse"="ReviewRentalHouse","Review"="Review","ReviewProduct"="ReviewProduct"})
 */
class Review {

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="votes", type="integer", nullable=true)
     */
    private $votes;

    /**
     * @var integer
     *
     * @ORM\Column(name="usefull", type="integer", nullable=true)
     */
    private $usefull;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show", type="boolean",options={"default"=false})
     */
    private $show;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Duser", inversedBy="reviews")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __construct() {
        $this->createdAt = new \DateTime('now');
        $this->show = false;
        $this->usefull = 0;
    }

    public function PlusUsefull() {
        $this->usefull++;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Review
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
     * Set votes
     *
     * @param integer $votes
     *
     * @return Review
     */
    public function setVotes($votes) {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Get votes
     *
     * @return integer
     */
    public function getVotes() {
        return $this->votes;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Review
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @param \Daiquiri\AdminBundle\Entity\DUser $user
     *
     * @return Review
     */
    public function setUser(\Daiquiri\AdminBundle\Entity\DUser $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Daiquiri\AdminBundle\Entity\DUser
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set show
     *
     * @param boolean $show
     *
     * @return Review
     */
    public function setShow($show) {
        $this->show = $show;

        return $this;
    }

    /**
     * Get show
     *
     * @return boolean
     */
    public function getShow() {
        return $this->show;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Review
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

    public function printStart() {

        $salida = '';
        for ($i = 0; $i < $this->votes; $i++) {
            $salida.= '<li><i class="fa fa-star"></i></li>';
        }

        return $salida;
    }

    /**
     * Set usefull
     *
     * @param integer $usefull
     *
     * @return Review
     */
    public function setUsefull($usefull) {
        $this->usefull = $usefull;

        return $this;
    }

    /**
     * Get usefull
     *
     * @return integer
     */
    public function getUsefull() {
        return $this->usefull;
    }

}
