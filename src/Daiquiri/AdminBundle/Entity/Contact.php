<?php

namespace Daiquiri\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact", indexes={@ORM\Index(name="IDX_4C62E638DDF06FB0", columns={"contact_cause"})})
 * @ORM\Entity(repositoryClass="Daiquiri\AdminBundle\Entity\ContactRepository")
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contact_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;



    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=2000, nullable=true)
     */
    private $message;

    /**
     * @var \Daiquiri\AdminBundle\Entity\ContactCause
     *
     * @ORM\ManyToOne(targetEntity="Daiquiri\AdminBundle\Entity\ContactCause", inversedBy="contacts", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contact_cause", referencedColumnName="id")
     * })
     */
    private $contactCause;



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
     * Set email
     *
     * @param string $email
     *
     * @return Contact
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
     * Set name
     *
     * @param string $name
     *
     * @return Contact
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
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set contactCause
     *
     * @param \Daiquiri\AdminBundle\Entity\ContactCause $contactCause
     *
     * @return Contact
     */
    public function setContactCause(\Daiquiri\AdminBundle\Entity\ContactCause $contactCause = null)
    {
        $this->contactCause = $contactCause;

        return $this;
    }

    /**
     * Get contactCause
     *
     * @return \Daiquiri\AdminBundle\Entity\ContactCause
     */
    public function getContactCause()
    {
        return $this->contactCause;
    }
}
