<?php
class Felhasznalo {
    private $nev;
    private $email;
    private $jelszo;
    private $uzenet;
    private $szint;
    private $mokusTipus;
    private $kep;
    private $suti;

    public function __construct($nev, $email, $jelszo, $uzenet, $szint, $mokusTipus, $kep, $suti=false) {
        $this->nev = $nev;
        $this->email = $email;
        $this->jelszo = $jelszo;
        $this->uzenet = $uzenet;
        $this->szint = $szint;
        $this->mokusTipus = $mokusTipus;
        $this->kep = $kep;
        $this->suti = $suti;
    }

    /**
     * @return mixed
     */
    public function getNev()
    {
        return $this->nev;
    }

    /**
     * @param mixed $nev
     */
    public function setNev($nev)
    {
        $this->nev = $nev;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getJelszo()
    {
        return $this->jelszo;
    }

    /**
     * @param mixed $jelszo
     */
    public function setJelszo($jelszo)
    {
        $this->jelszo = $jelszo;
    }

    /**
     * @return mixed
     */
    public function getUzenet()
    {
        return $this->uzenet;
    }

    /**
     * @param mixed $uzenet
     */
    public function setUzenet($uzenet)
    {
        $this->uzenet = $uzenet;
    }

    /**
     * @return mixed
     */
    public function getSzint()
    {
        return $this->szint;
    }

    /**
     * @param mixed $szint
     */
    public function setSzint($szint)
    {
        $this->szint = $szint;
    }

    /**
     * @return mixed
     */
    public function getMokusTipus()
    {
        return $this->mokusTipus;
    }

    /**
     * @param mixed $mokusTipus
     */
    public function setMokusTipus($mokusTipus)
    {
        $this->mokusTipus = $mokusTipus;
    }

    /**
     * @return string
     */
    public function getKep(): string
    {
        return $this->kep;
    }

    /**
     * @param string $kep
     */
    public function setKep(string $kep)
    {
        $this->kep = $kep;
    }

    /**
     * @return false|mixed
     */
    public function getSuti()
    {
        return $this->suti;
    }

    /**
     * @param false|mixed $suti
     */
    public function setSuti($suti)
    {
        $this->suti = $suti;
    }

}