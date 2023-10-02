<?php

include_once('../classes/Dog.php');
include_once('../classes/Repro.php');

class Litter extends Repro
{
    private $birthdate;
    private ?Repro $mother = null;
    private ?Repro $father = null;
    private Int $numberPuppies = 1;
    private Int $numberMales = 0;
    private Int $numberFemales = 0;
    private String $litterNumberSCC;

    function __construct($birthdate, ?Repro $mother, ?Repro $father, Int $numberPuppies, Int $numberMales, String $litterNumberSCC)
    {
        $this->birthdate = $birthdate;
        $this->mother = $mother;
        $this->father = $father;
        $this->numberPuppies = $numberPuppies;
        $this->numberMales = $numberMales;
        $this->litterNumberSCC = $litterNumberSCC;
    }
    /**
     * Get the value of birthdate
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     * @return  self
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get the value of mother
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Set the value of mother
     *
     * @return  self
     */
    public function setMother($mother)
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * Get the value of father
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set the value of father
     *
     * @return  self
     */
    public function setFather($father)
    {
        $this->father = $father;

        return $this;
    }

    /**
     * Get the value of numberPuppies
     */
    public function getNumberPuppies()
    {
        return $this->numberPuppies;
    }

    /**
     * Set the value of numberPuppies
     *
     * @return  self
     */
    public function setNumberPuppies($numberPuppies)
    {
        $this->numberPuppies = $numberPuppies;

        return $this;
    }

    /**
     * Get the value of numberMales
     */
    public function getNumberMales()
    {
        return $this->numberMales;
    }

    /**
     * Set the value of numberMales
     *
     * @return  self
     */
    public function setNumberMales($numberMales)
    {
        $this->numberMales = $numberMales;

        return $this;
    }

    /**
     * Get the value of numberFemales
     */
    public function getNumberFemales()
    {
        return $this->numberFemales;
    }

    /**
     * Set the value of numberFemales
     *
     * @return  self
     */
    public function setNumberFemales($numberPuppies, $numberMales)
    {
        $this->numberFemales = $numberPuppies - $numberMales;
        return $this;
    }

    /**
     * Get the value of litterNumberSCC
     */
    public function getLitterNumberSCC()
    {
        return $this->litterNumberSCC;
    }

    /**
     * Set the value of litterNumberSCC
     *
     * @return  self
     */
    public function setLitterNumberSCC($litterNumberSCC)
    {
        $this->litterNumberSCC = $litterNumberSCC;

        return $this;
    }
}