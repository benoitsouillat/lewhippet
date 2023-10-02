<?php

include_once('../classes/Dog.php');
include_once('../classes/Repro.php');

class Litter extends Repro
{
    protected $birthdate;
    protected ?Repro $mother = null;
    protected ?Repro $father = null;
    protected Int $numberPuppies = 1;
    protected Int $numberMales = 0;
    protected Int $numberFemales = 0;
    protected String $litterNumberSCC;

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
