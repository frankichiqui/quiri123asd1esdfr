<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackageOptionSearcher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PackageOptionSearcher extends Searcher{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Package")
     * @ORM\JoinColumn(name="package", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $package;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date")
     */
    private $startdate;

   /**
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\Polo")
     * @ORM\JoinTable(name="packageoptionsearcher_polo",
     *      joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")}
     *      )
     */
    private $destinations;

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer")
     */
    private $days;

    /**
     * @var integer
     *
     * @ORM\Column(name="night", type="integer")
     */
    private $night;

    /**
     * @var integer
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var integer
     *
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids;
    /**
     * @var integer
     *
     * @ORM\Column(name="infant", type="integer")
     */
    private $infant;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->destinations = new \Doctrine\Common\Collections\ArrayCollection();
    }

   

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return PackageOptionSearcher
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return PackageOptionSearcher
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set night
     *
     * @param integer $night
     *
     * @return PackageOptionSearcher
     */
    public function setNight($night)
    {
        $this->night = $night;

        return $this;
    }

    /**
     * Get night
     *
     * @return integer
     */
    public function getNight()
    {
        return $this->night;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return PackageOptionSearcher
     */
    public function setAdults($adults)
    {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * Set kids
     *
     * @param integer $kids
     *
     * @return PackageOptionSearcher
     */
    public function setKids($kids)
    {
        $this->kids = $kids;

        return $this;
    }

    /**
     * Get kids
     *
     * @return integer
     */
    public function getKids()
    {
        return $this->kids;
    }

    /**
     * Set infant
     *
     * @param integer $infant
     *
     * @return PackageOptionSearcher
     */
    public function setInfant($infant)
    {
        $this->infant = $infant;

        return $this;
    }

    /**
     * Get infant
     *
     * @return integer
     */
    public function getInfant()
    {
        return $this->infant;
    }

    /**
     * Set package
     *
     * @param \Daiquiri\AdminBundle\Entity\Package $package
     *
     * @return PackageOptionSearcher
     */
    public function setPackage(\Daiquiri\AdminBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Daiquiri\AdminBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Add destination
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $destination
     *
     * @return PackageOptionSearcher
     */
    public function addDestination(\Daiquiri\AdminBundle\Entity\Polo $destination)
    {
        $this->destinations[] = $destination;

        return $this;
    }

    /**
     * Remove destination
     *
     * @param \Daiquiri\AdminBundle\Entity\Polo $destination
     */
    public function removeDestination(\Daiquiri\AdminBundle\Entity\Polo $destination)
    {
        $this->destinations->removeElement($destination);
    }

    /**
     * Get destinations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinations()
    {
        return $this->destinations;
    }
    
    
   

}
