<?php

include_once('../classes/Dog.php');
include_once('../classes/Repro.php');

class Litter extends Repro
{
    protected $birthdate;
    protected Repro $mother;
    protected Repro $father;
    protected Int $numberPuppies;
    protected Int $numberMales;
    protected Int $numberFemales;

    function __construct($birthdate, Repro $mother, Repro $father, Int $numberPuppies, Int $numberMales, Int $numberFemales)
    {
        $this->birthdate = $birthdate;
        $this->mother = $mother;
        $this->father = $father;
        $this->numberPuppies = $numberPuppies;
        $this->numberMales = $numberMales;
        $this->numberFemales = $numberFemales;
    }
}
