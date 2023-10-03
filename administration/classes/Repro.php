<?php

require_once(__DIR__ . '/../../secret/connexion.php');
require_once(__DIR__ . '/../sql/repros_request.php');
require_once(__DIR__ . '/Dog.php');

class Repro extends Dog
{

    private $insert;
    private $description;
    private $breeder;
    private $birthdate;
    private $lofselect;
    private $adn;
    private $champion;

    public function __construct(
        string $name = '',
        string $sex = '',
        string $color = '',
        string $mainImgPath = '',
        string $insert = '',
        string $description = '',
        string $breeder = '',
        $birthdate = '',
        $lofselect = '',
        $adn = '',
        $champion = ''
    ) {
        parent::__construct($name, $sex, $color, $mainImgPath);
        $this->insert = $insert;
        $this->description = $description;
        $this->breeder = $breeder;
        $this->birthdate = $birthdate;
        $this->lofselect = $lofselect;
        $this->adn = $adn;
        $this->champion = $champion;
    }

    public function fetchFromDatabase($id)
    {

        $stmt = $conn->prepare(getReproFromId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($reproFetch = $stmt->fetch(PDO::FETCH_OBJ)) {
            // Mettez à jour les propriétés de l'objet avec les données de la base de données
            $this->setName($reproFetch->name);
            $this->setSex($reproFetch->sex);
            // Continuez avec les autres propriétés...
        }
    }

    public function fillFromStdClass(stdClass $data)
    {
        $this->setName($data->name);
        $this->setSex($data->sex);
        $this->setColor($data->color);
        $this->setInsert($data->insert);
        $this->setDescription($data->description);
        $this->setBreeder($data->breeder);
        $this->setBirthdate($data->birth_date);
        $this->setLofselect($data->lofselect_link);
        $this->setIsAdn($data->is_adn);
        $this->setIsChampion($data->is_champion);
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
        $this->description = $description;
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