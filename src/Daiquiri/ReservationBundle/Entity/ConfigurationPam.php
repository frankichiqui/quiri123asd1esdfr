<?php

namespace Daiquiri\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigurationPam
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Daiquiri\ReservationBundle\Entity\ConfigurationPamRepository")
 * 
 */
class ConfigurationPam extends ConfigurationTPV {

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
     * @ORM\Column(name="key_pam_eur", type="string", length=255)
     */
    private $keyPamEur;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_pam_eur", type="integer")
     */
    private $codePamEur;

    /**
     * @var string
     *
     * @ORM\Column(name="key_pam_usd", type="string", length=255)
     */
    private $keyPamUsd;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_pam_usd", type="integer")
     */
    private $codePamUsd;

    /**
     * @var string
     *
     * @ORM\Column(name="comercio", type="string", length=255)
     */
    private $comercio;

    /**
     * @var string
     *
     * @ORM\Column(name="pasarela", type="string", length=255)
     */
    private $pasarela;

    /**
     * @var string
     *
     * @ORM\Column(name="absolute_dir", type="string", length=255)
     */
    private $absoluteDir;

    /**
     * @var string
     *
     * @ORM\Column(name="url_recive", type="string", length=255)
     */
    private $urlRecive;

    /**
     * @var string
     *
     * @ORM\Column(name="url_ok", type="string", length=255)
     */
    private $urlOk;

    /**
     * @var string
     *
     * @ORM\Column(name="url_ko", type="string", length=255)
     */
    private $urlKo;

    /**
     * Set keyPamEur
     *
     * @param string $keyPamEur
     *
     * @return ConfigurationPam
     */
    public function setKeyPamEur($keyPamEur) {
        $this->keyPamEur = $keyPamEur;

        return $this;
    }

    /**
     * Get keyPamEur
     *
     * @return string
     */
    public function getKeyPamEur() {
        return $this->keyPamEur;
    }

    public function getKey($currency) {
        if ('usd' == strtolower($currency)) {
            return $this->getKeyPamUsd();
        }
        if ('eur' == strtolower($currency)) {
            return $this->getKeyPamEur();
        }
        return null;
    }

    /**
     * Set codePamEur
     *
     * @param integer $codePamEur
     *
     * @return ConfigurationPam
     */
    public function setCodePamEur($codePamEur) {
        $this->codePamEur = $codePamEur;

        return $this;
    }

    /**
     * Get codePamEur
     *
     * @return integer
     */
    public function getCodePamEur() {
        return $this->codePamEur;
    }

    /**
     * Set keyPamUsd
     *
     * @param string $keyPamUsd
     *
     * @return ConfigurationPam
     */
    public function setKeyPamUsd($keyPamUsd) {
        $this->keyPamUsd = $keyPamUsd;

        return $this;
    }

    /**
     * Get keyPamUsd
     *
     * @return string
     */
    public function getKeyPamUsd() {
        return $this->keyPamUsd;
    }

    /**
     * Set codePamUsd
     *
     * @param integer $codePamUsd
     *
     * @return ConfigurationPam
     */
    public function setCodePamUsd($codePamUsd) {
        $this->codePamUsd = $codePamUsd;

        return $this;
    }

    /**
     * Get codePamUsd
     *
     * @return integer
     */
    public function getCodePamUsd() {
        return $this->codePamUsd;
    }

    /**
     * Set comercio
     *
     * @param string $comercio
     *
     * @return ConfigurationPam
     */
    public function setComercio($comercio) {
        $this->comercio = $comercio;

        return $this;
    }

    /**
     * Get comercio
     *
     * @return string
     */
    public function getComercio() {
        return $this->comercio;
    }

    /**
     * Set pasarela
     *
     * @param string $pasarela
     *
     * @return ConfigurationPam
     */
    public function setPasarela($pasarela) {
        $this->pasarela = $pasarela;

        return $this;
    }

    /**
     * Get pasarela
     *
     * @return string
     */
    public function getPasarela() {
        return $this->pasarela;
    }

    /**
     * Set absoluteDir
     *
     * @param string $absoluteDir
     *
     * @return ConfigurationPam
     */
    public function setAbsoluteDir($absoluteDir) {
        $this->absoluteDir = $absoluteDir;

        return $this;
    }

    /**
     * Get absoluteDir
     *
     * @return string
     */
    public function getAbsoluteDir() {
        return $this->absoluteDir;
    }

    /**
     * Set urlRecive
     *
     * @param string $urlRecive
     *
     * @return ConfigurationPam
     */
    public function setUrlRecive($urlRecive) {
        $this->urlRecive = $urlRecive;

        return $this;
    }

    /**
     * Get urlRecive
     *
     * @return string
     */
    public function getUrlRecive() {
        return $this->urlRecive;
    }

    /**
     * Set urlOk
     *
     * @param string $urlOk
     *
     * @return ConfigurationPam
     */
    public function setUrlOk($urlOk) {
        $this->urlOk = $urlOk;

        return $this;
    }

    /**
     * Get urlOk
     *
     * @return string
     */
    public function getUrlOk() {
        return $this->urlOk;
    }

    /**
     * Set urlKo
     *
     * @param string $urlKo
     *
     * @return ConfigurationPam
     */
    public function setUrlKo($urlKo) {
        $this->urlKo = $urlKo;

        return $this;
    }

    /**
     * Get urlKo
     *
     * @return string
     */
    public function getUrlKo() {
        return $this->urlKo;
    }

}
