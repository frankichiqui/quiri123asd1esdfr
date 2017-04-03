<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Searcher
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string")
 * @ORM\DiscriminatorMap({"Searcher"="Searcher","CarSearcher"="CarSearcher","CircuitSearcher"="CircuitSearcher","ExcursionSearcher"="ExcursionSearcher","OcupationSearcher"="OcupationSearcher","PackageOptionSearcher"="PackageOptionSearcher","RentalHouseRoomSearcher"="RentalHouseRoomSearcher","TransferSearcher"="TransferSearcher"})
 */
class Searcher {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="duration", type="float",nullable=true, options={"default"=0})
     */
    private $duration;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime" , nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="Result", mappedBy="searcher", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     */
    private $results;

    /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\DUser", cascade={"persist","refresh", "merge"}, inversedBy="searchers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return TransferSearcher
     */
    public function setCreateAt($createAt) {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt() {
        return $this->createAt;
    }

    /**
     * Set user
     *
     * @param \Daiquiri\AdminBundle\Entity\DUser $user
     *
     * @return TransferSearcher
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
     * Constructor
     */
    public function __construct() {
        $this->results = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add result
     *
     * @param \Daiquiri\ReservationBundle\Entity\Result $result
     *
     * @return Searcher
     */
    public function addResult(\Daiquiri\ReservationBundle\Entity\Result $result) {
        $result->setSearcher($this);
        $this->results[] = $result;

        return $this;
    }

    public function setResults(\Doctrine\Common\Collections\ArrayCollection $results) {
        $new = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($results as $c) {
            $this->addResult($c);
            $new->add($c);
        }
        $this->results = $new;
        return $this;
    }

    /**
     * Remove result
     *
     * @param \Daiquiri\ReservationBundle\Entity\Result $result
     */
    public function removeResult(\Daiquiri\ReservationBundle\Entity\Result $result) {
        $result->setSearcher();
        $this->results->removeElement($result);
    }

    /**
     * Get results
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResults() {
        return $this->results;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return Searcher
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration() {
        return round($this->duration);
    }

    public function getDurationS() {
        return round($this->duration, 2);
    }

}
