<?php

include_once(__DIR__ . '/Dog.php');
include_once(__DIR__ . '/Repro.php');
include_once(__DIR__ . '/Puppy.php');
include_once(__DIR__ . '/../sql/litters_request.php');
require_once(__DIR__ . '/../sql/puppies_request.php');
require_once(__DIR__ . '/../../secret/connexion.php');

class Litter
{
    private $id = 0;
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

    public function fillFromStdClass(stdClass $data, $conn)
    {
        $this->setId($data->id);
        $this->setBirthdate($data->birthdate);
        $mother = new Repro();
        $mother->fetchFromDatabase($data->mother_id, $conn);
        $this->setMother($mother);
        $father = new Repro();
        $father->fetchFromDatabase($data->father_id, $conn);
        $this->setFather($father);
        $this->setNumberPuppies($data->number_of_puppies);
        $this->setNumberMales($data->number_of_males);
        $this->setNumberFemales($data->number_of_females);
        $this->setLitterNumberSCC($data->litter_number);
    }
    public function fetchFromDatabase($id, $conn)
    {
        $stmt = $conn->prepare(getLitterFromId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($litterFetch = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->fillFromStdClass($litterFetch, $conn);
        }
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
    public function generatePuppiesMales($conn)
    {
        $stmt = $conn->prepare(getAllLitters());
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lastId = end($result)['id'];

        for ($i = 0; $i < $this->getNumberMales(); $i++) {
            //Création d'un nouveau chiot Mâle
            $puppyMale = new Puppy();
            $puppyMale->setName('Mâle N°' . $i + 1);

            //Récupération de la Portée qui vient d'être enregistrée
            $litterStmt = $conn->prepare(getLitterFromId());
            $litterStmt->bindParam(':id', $lastId);
            $litterStmt->execute();
            $litterData = $litterStmt->fetch(PDO::FETCH_OBJ);
            $litter = new Litter();
            $litter->fillFromStdClass($litterData, $conn);
            $puppyMale->setLitter($litter);

            //Récupèration de la position
            $stmt_id = $conn->prepare("SELECT id from puppies");
            $stmt_id->execute();
            $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
            $position = end($id_array)->id + 1 + $i;
            $puppyMale->setPosition($position);

            $puppyName = $puppyMale->getName();
            $puppySex = 'male';
            $puppyColor = "Grise";
            $puppyDescription = '';
            $puppyAvailable = 'Disponible';
            $puppyEnable = 0;
            $puppyLitterId = $puppyMale->getLitter()->getId();
            $puppyMainImg = '../../default.jpg';
            $puppyPosition = $puppyMale->getPosition();

            $stmt = $conn->prepare(createPuppy());
            $stmt->bindParam(':name', $puppyName);
            $stmt->bindParam(':sex', $puppySex);
            $stmt->bindParam(':color', $puppyColor);
            $stmt->bindParam(':description', $puppyDescription);
            $stmt->bindParam(':available', $puppyAvailable);
            $stmt->bindParam(':enable', $puppyEnable);
            $stmt->bindParam(':litter_id', $puppyLitterId);
            $stmt->bindParam(':main_img_path', $puppyMainImg);
            $stmt->bindParam(':position', $puppyPosition);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Erreur suivante : ' . $e;
            }
        }
    }
    public function generatePuppiesFemales($conn)
    {
        $stmt = $conn->prepare(getAllLitters());
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lastId = end($result)['id'];

        for ($i = 0; $i < $this->getNumberFemales(); $i++) {
            //Création d'un nouveau chiot Femelle
            $puppyFemale = new Puppy();
            $puppyFemale->setName('Femelle N°' . $i + 1);

            //Récupération de la Portée qui vient d'être enregistrée
            $litterStmt = $conn->prepare(getLitterFromId());
            $litterStmt->bindParam(':id', $lastId);
            $litterStmt->execute();
            $litterData = $litterStmt->fetch(PDO::FETCH_OBJ);
            $litter = new Litter();
            $litter->fillFromStdClass($litterData, $conn);
            $puppyFemale->setLitter($litter);

            //Récupèration de la position
            $stmt_id = $conn->prepare("SELECT id from puppies");
            $stmt_id->execute();
            $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
            $position = end($id_array)->id + 1 + $i + $this->getNumberMales();
            $puppyFemale->setPosition($position);

            $puppyName = $puppyFemale->getName();
            $puppySex = 'femelle';
            $puppyColor = "Grise";
            $puppyDescription = '';
            $puppyAvailable = 'Disponible';
            $puppyEnable = 0;
            $puppyLitterId = $puppyFemale->getLitter()->getId();
            $puppyMainImg = '../../default.jpg';
            $puppyPosition = $puppyFemale->getPosition();

            $stmt = $conn->prepare(createPuppy());
            $stmt->bindParam(':name', $puppyName);
            $stmt->bindParam(':sex', $puppySex);
            $stmt->bindParam(':color', $puppyColor);
            $stmt->bindParam(':description', $puppyDescription);
            $stmt->bindParam(':available', $puppyAvailable);
            $stmt->bindParam(':enable', $puppyEnable);
            $stmt->bindParam(':litter_id', $puppyLitterId);
            $stmt->bindParam(':main_img_path', $puppyMainImg);
            $stmt->bindParam(':position', $puppyPosition);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Erreur suivante : ' . $e;
            }
        }
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
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
