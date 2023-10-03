<?php

include_once(__DIR__ . '/Dog.php');
include_once(__DIR__ . '/Repro.php');

class Litter
{
    private $birthdate = '';
    private ?Repro $mother = null;
    private ?Repro $father = null;
    private Int $numberPuppies = 1;
    private Int $numberMales = 0;
    private Int $numberFemales = 0;
    private String $litterNumberSCC = '';

    function __construct(
        $birthdate = '',
        ?Repro $mother = null,
        ?Repro $father = null,
        Int $numberPuppies = 0,
        Int $numberMales = 0,
        String $litterNumberSCC = ''
    ) {
        $this->birthdate = $birthdate;
        $this->mother = $mother;
        $this->father = $father;
        $this->numberPuppies = $numberPuppies;
        $this->numberMales = $numberMales;
        $this->litterNumberSCC = $litterNumberSCC;
    }

    public function fillFromStdClass(stdClass $data)
    {
        $this->setBirthdate($data->birthdate);
        $mother = new Repro();
        $mother->fetchFromDatabase($data->mother_id);
        $this->setMother($mother);
        $father = new Repro();
        $father->fetchFromDatabase($data->father_id);
        $this->setMother($father);
        $this->setNumberPuppies($data->number_of_puppies);
        $this->setNumberMales($data->number_of_males);
        $this->setNumberFemales($data->number_of_females);
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
    public function setNumberFemales($numberFemales)
    {
        $this->numberFemales = $numberFemales;
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