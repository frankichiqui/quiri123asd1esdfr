<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
#use Application\Sonata\UserBundle\Entity\User as AUser;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Symfony\Component\Validator\Constraints as Contraint;

/**
 * DUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\DUserRepository")
 */
class DUser extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $passport
     * @ORM\Column(name="passport", type="bigint", nullable=true)
     */
    protected $passport;

    /**
     * @var string $facebook_id
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    private $facebook_id;
    private $facebookAccessToken;

    /**
     * @var string $google_id
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private $google_id;
    private $googleAccessToken;

    /**
     * @var string $twitter_id
     * @ORM\Column(name="twitter_id", type="string", nullable=true)
     */
    private $twitter_id;
    private $twitterAccessToken;

    /**
     * @var string $avatar
     * @ORM\Column(name="avatar", type="string", nullable=true)
     */
    private $avatar;

    /**
     * @var string $picture
     * 
     * @ORM\Column(name="picture", type="string", nullable=true)
     * @Contraint\File(maxSize="6000000",mimeTypes={"image/bmp","image/x-windows-bmp","image/gif","image/x-icon","image/jpeg","image/pjpeg","image/pict","image/png","image/tiff","image/x-tiff","image/x-jg"})
     */
    private $picture;

    /**
     * @var string $address
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    private $address;

    /**
     * @var string $city
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;

    /**
     * @var string $state
     * @ORM\Column(name="state", type="string", nullable=true)
     */
    private $state;

    /**
     * @var integer $zipcode
     * @ORM\Column(name="zipcode", type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @var string $country
     * @ORM\Column(name="country", type="string", nullable=true)
     */
    private $country;

//    /**
//     * @var VoteSelf
//     */
//    private $votesself;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\AdminBundle\Entity\Review", mappedBy="user")
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\Sale", mappedBy="client")
     */
    private $sales;
    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\Service", mappedBy="status_by_user")
     */
    private $status_services;

    /**
     * @ORM\OneToMany(targetEntity="Daiquiri\ReservationBundle\Entity\Searcher", mappedBy="user")
     */
    private $searchers;

//    /**
//     * @var \Daiquiri\AdminBundle\Entity\Review
//     *
//     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\Review", inversedBy="usersVotes")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="user_review_vote", referencedColumnName="id")
//     * })
//     */
//    private $review;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct() {

        //$this->get
        parent::__construct();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        $this->searchers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status_services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     *
     * @return DUser
     */
    public function addReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review $review
     */
    public function removeReview(\Daiquiri\AdminBundle\Entity\Review $review) {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews() {
        return $this->reviews;
    }

    /**
     * Set passport
     *
     * @return User
     */
    public function setPassport($passport) {
        $this->passport = $passport;
        return $this;
    }

    /**
     * Get passport
     *
     * @return bigint $passport
     */
    public function getPassport() {
        return $this->passport;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId) {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId() {
        return $this->facebook_id;
    }

    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken) {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken() {
        return $this->facebookAccessToken;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId) {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId() {
        return $this->google_id;
    }

    /**
     * @param string $googleAccessToken
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken) {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleAccessToken() {
        return $this->googleAccessToken;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     *
     * @return User
     */
    public function setTwitterId($twitterId) {
        $this->twitter_id = $twitterId;

        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string
     */
    public function getTwitterId() {
        return $this->twitter_id;
    }

    /**
     * @param string $twitterAccessToken
     * @return User
     */
    public function setTwitterAccessToken($twitterAccessToken) {
        $this->twitterAccessToken = $twitterAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterAccessToken() {
        return $this->twitterAccessToken;
    }

    /**
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar) {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar() {
        return $this->avatar;
    }

    /**
     * @return string
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return User
     */
    public function setPicture($picture) {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @param string $state
     * @return User
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * @return integer
     */
    public function getZipcode() {
        return $this->zipcode;
    }

    /**
     * @param integer $zipcode
     * @return User
     */
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param string $country
     * @return User
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    
    /**
     * Set review
     *
     * @param \Daiquiri\AdminBundle\Entity\Review
     *
     * @return DUser
     */
    public function setReview(\Daiquiri\AdminBundle\Entity\Review $review = null) {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return \Daiquiri\AdminBundle\Entity\Review
     */
    public function getReview() {
        return $this->review;
    }

    public function getFullname() {
        if ($this->getFirstname() && $this->getLastname()) {
            return $this->firstname . ' ' . $this->lastname;
        }
        return $this->username;
    }

    /**
     * Add searcher
     *
     * @param \Daiquiri\ReservationBUndle\Entity\Searcher $searcher
     *
     * @return DUser
     */
    public function addSearcher(\Daiquiri\ReservationBUndle\Entity\Searcher $searcher) {
        $this->searchers[] = $searcher;

        return $this;
    }

    /**
     * Remove searcher
     *
     * @param \Daiquiri\ReservationBUndle\Entity\Searcher $searcher
     */
    public function removeSearcher(\Daiquiri\ReservationBUndle\Entity\Searcher $searcher) {
        $this->searchers->removeElement($searcher);
    }

    /**
     * Get searchers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSearchers() {
        return $this->searchers;
    }

    /**
     * Add sale
     *
     * @param \Daiquiri\ReservationBundle\Entity\Sale $sale
     *
     * @return DUser
     */
    public function addSale(\Daiquiri\ReservationBundle\Entity\Sale $sale) {
        $this->sales[] = $sale;

        return $this;
    }

    /**
     * Remove sale
     *
     * @param \Daiquiri\ReservationBundle\Entity\Sale $sale
     */
    public function removeSale(\Daiquiri\ReservationBundle\Entity\Sale $sale) {
        $this->sales->removeElement($sale);
    }

    /**
     * Get sales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSales() {
        return $this->sales;
    }


    /**
     * Add statusService
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $statusService
     *
     * @return DUser
     */
    public function addStatusService(\Daiquiri\ReservationBundle\Entity\Service $statusService)
    {
        $this->status_services[] = $statusService;

        return $this;
    }

    /**
     * Remove statusService
     *
     * @param \Daiquiri\ReservationBundle\Entity\Service $statusService
     */
    public function removeStatusService(\Daiquiri\ReservationBundle\Entity\Service $statusService)
    {
        $this->status_services->removeElement($statusService);
    }

    /**
     * Get statusServices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatusServices()
    {
        return $this->status_services;
    }
}
