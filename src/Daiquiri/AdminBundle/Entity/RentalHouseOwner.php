<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RentalHouseOwner
 *
 * @ORM\Table(name="rental_house_owner")
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\RentalHouseOwnerRepository")
 */
class RentalHouseOwner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rental_house_owner_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=255)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=255, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=2000, nullable=true)
     */
    private $address;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Daiquiri\AdminBundle\Entity\RentalHouse", mappedBy="rental_house_owners")
     */
    private $rental_houses;
     /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"name", "lastname"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, nullable = false)
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"id", "name" , "lastname"})
     */
    private $uniqueSlug;
    /**
     * @var string
     *
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;
     /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
    private $picture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rental_houses = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return RentalHouseOwner
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RentalHouseOwner
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return RentalHouseOwner
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     *
     * @return RentalHouseOwner
     */
    public function addRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse)
    {
        $this->rental_houses[] = $rentalHouse;

        return $this;
    }

    /**
     * Remove rentalHouse
     *
     * @param \Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse
     */
    public function removeRentalHouse(\Daiquiri\AdminBundle\Entity\RentalHouse $rentalHouse)
    {
        $this->rental_houses->removeElement($rentalHouse);
    }

    /**
     * Get rentalHouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentalHouses()
    {
        return $this->rental_houses;
    }
    
    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return RentalHouseOwner
     */
    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return RentalHouseOwner
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     *
     * @return RentalHouseOwner
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     *
     * @return RentalHouseOwner
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return RentalHouseOwner
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set uniqueSlug
     *
     * @param string $uniqueSlug
     *
     * @return RentalHouseOwner
     */
    public function setUniqueSlug($uniqueSlug)
    {
        $this->uniqueSlug = $uniqueSlug;

        return $this;
    }

    /**
     * Get uniqueSlug
     *
     * @return string
     */
    public function getUniqueSlug()
    {
        return $this->uniqueSlug;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return RentalHouseOwner
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }
    public function __toString() {
        return $this->name." ".$this->lastname;
    }
}
