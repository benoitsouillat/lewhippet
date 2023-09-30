<?php

require_once('../classes/Dog.php');

class Repro extends Dog
{

    protected $insert;
    protected $description;
    protected $breeder;
    protected $birthdate;
    protected $lofselect;
    protected $adn;
    protected $champion;

    public function __construct(string $name, string $sex, String $color, String $insert, String $description, $breeder, $birthdate, $lofselect, $adn, $champion)
    {
        parent::__construct($name, $sex, $color);
        $this->insert = $insert;
        $this->description = $description;
        $this->breeder = $breeder;
        $this->birthdate = $birthdate;
        $this->lofselect = $lofselect;
        $this->adn = $adn;
        $this->champion = $champion;
    }

    public function fillFromStdClass(stdClass $data)
    {
        $this->name = $data->name;
        $this->sex = $data->sex;
        $this->color = $data->color;
        $this->insert = $data->insert;
        $this->description = $data->description;
        $this->breeder = $data->breeder;
        $this->birthdate = $data->birth_date;
        $this->lofselect = $data->lofselect_link;
        $this->adn = $data->is_adn;
        $this->champion = $data->is_champion;
    }
    public function getInsert()
    {
        return $this->insert;
    }
    public function setInsert($insert)
    {
        $this->insert = $insert;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->$description = $description;
    }
    public function getBreeder()
    {
        return $this->breeder;
    }
    public function setBreeder($breeder)
    {
        $this->breeder = $breeder;
    }
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function getLofselect()
    {
        return $this->lofselect;
    }
    public function setLofselect($lofselect)
    {
        $this->lofselect = $lofselect;
    }
    public function getIsAdn()
    {
        return $this->adn;
    }
    public function setIsAdn($adn)
    {
        $this->adn = $adn;
    }
    public function getIsChampion()
    {
        return $this->champion;
    }
    public function setIsChampion($champion)
    {
        $this->champion = $champion;
    }
};
