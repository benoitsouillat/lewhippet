<?php

include_once(__DIR__ . '/../../secret/connexion.php');
require_once(__DIR__ . '/../sql/repros_request.php');
require_once(__DIR__ . '/Dog.php');

class Repro extends Dog
{

    private $id;
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

    public function fetchFromDatabase($id, $conn)
    {
        // $dsn = "mysql:host=localhost;port=3306;dbname=damoiseaux_php";
        // $conn = new PDO($dsn, 'root', '');
        $stmt = $conn->prepare(getReproFromId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($reproFetch = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->id = $reproFetch->id;
            $this->fillFromStdClass($reproFetch);
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
        $this->setMainImgPath($data->main_img_path);
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

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
};
