<?php

include_once(__DIR__ . '/Dog.php');
include_once(__DIR__ . '/Repro.php');
include_once(__DIR__ . '/Puppy.php');
include_once(__DIR__ . '/../sql/litters_request.php');
require_once(__DIR__ . '/../sql/puppies_request.php');
// require_once(__DIR__ . '/../../secret/connexion.php');
require_once(__DIR__ . '/../../database/requestPDO.php');

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
    private bool $enable = false;
    private int $position = 1;
    private ?RequestPDO $pdo = null;

    function __construct(
        $birthdate = '2020-01-01',
        ?Repro $mother = null,
        ?Repro $father = null,
        Int $numberPuppies = 0,
        Int $numberMales = 0,
        String $litterNumberSCC = '',
        Bool $enable = false,
    ) {
        $this->birthdate = $birthdate;
        $this->mother = $mother;
        $this->father = $father;
        $this->numberPuppies = $numberPuppies;
        $this->numberMales = $numberMales;
        $this->numberFemales = $numberPuppies - $numberMales;
        $this->litterNumberSCC = $litterNumberSCC;
        $this->enable = $enable;
        $this->pdo = new RequestPDO;
    }

    public function fillFromStdClass(stdClass $data)
    {
        $this->setId($data->id);
        $this->setBirthdate($data->birthdate);
        $mother = new Repro();
        $mother->fetchFromDatabase($data->mother_id);
        $this->setMother($mother);
        $father = new Repro();
        $father->fetchFromDatabase($data->father_id);
        $this->setFather($father);
        $this->setNumberPuppies($data->number_of_puppies);
        $this->setNumberMales($data->number_of_males);
        $this->setNumberFemales($data->number_of_females);
        $this->setLitterNumberSCC($data->litter_number);
        $this->setEnable($data->enable);
        $this->setPosition($data->position);
    }
    public function fetchFromDatabase($id)
    {
        $stmt = $this->pdo->connect()->prepare(getLitterFromId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($litterFetch = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->fillFromStdClass($litterFetch);
        }
    }

    public function fetchToDatabase()
    {
        $stmt = $this->pdo->connect()->prepare(createLitter());
        $stmt->bindValue(':birthdate', $this->getBirthdate());
        $stmt->bindValue(':mother_id', $this->getMother()->getId());
        $stmt->bindValue(':father_id', $this->getFather()->getId());
        $stmt->bindValue(':numberPuppies', $this->getNumberPuppies());
        $stmt->bindValue(':numberMales', $this->getNumberMales());
        $stmt->bindValue(':numberFemales', $this->getNumberFemales());
        $stmt->bindValue(':litterNumberSCC', $this->getLitterNumberSCC());
        $stmt->bindValue(':position', $this->getPosition());
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement de la portée" . $e;
        }
    }
    public function generatePuppiesMales()
    {
        $stmt = $this->pdo->connect()->prepare(getAllLitters());
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lastId = end($result)['id'];

        for ($i = 0; $i < $this->getNumberMales(); $i++) {
            //Création d'un nouveau chiot Mâle
            $puppyMale = new Puppy();
            $puppyMale->setName('Mâle N°' . $i + 1);

            //Récupération de la Portée qui vient d'être enregistrée
            $litterStmt = $this->pdo->connect()->prepare(getLitterFromId());
            $litterStmt->bindParam(':id', $lastId);
            try {
                $litterStmt->execute();
            } catch (PDOException $e) {
                echo "Une erreur s'est produite lors de la récupération de l'id de la portée";
            }
            $litterData = $litterStmt->fetch(PDO::FETCH_OBJ);
            $litter = new Litter();
            $litter->fillFromStdClass($litterData);
            $puppyMale->setLitter($litter);

            //Récupèration de la position
            $stmt_id = $this->pdo->connect()->prepare("SELECT id FROM puppies");
            $stmt_id->execute();
            $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
            if (empty($id_array)) {
                $position = 1;
            } else {
                $position = end($id_array)->id + 1 + $i;
            }
            $puppyMale->setPosition($position);

            $puppyName = $puppyMale->getName();
            $puppySex = 'male';
            $puppyColor = "Grise";
            $puppyDescription = '';
            $puppyAvailable = 'Disponible';
            $puppyEnable = 0;
            $puppyLitterId = $puppyMale->getLitter()->getId();
            $puppyMainImg = '../../puppies_img/default.jpg';
            $puppyPosition = $puppyMale->getPosition();

            $stmt = $this->pdo->connect()->prepare(createPuppy());
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
                echo 'Erreur lors de la création d\'un mâle : ' . $e;
            }
        }
    }
    public function generatePuppiesFemales()
    {
        $stmt = $this->pdo->connect()->prepare(getAllLitters());
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lastId = end($result)['id'];

        for ($i = 0; $i < $this->getNumberFemales(); $i++) {
            //Création d'un nouveau chiot Femelle
            $puppyFemale = new Puppy();
            $puppyFemale->setName('Femelle N°' . $i + 1);

            //Récupération de la Portée qui vient d'être enregistrée
            $litterStmt = $this->pdo->connect()->prepare(getLitterFromId());
            $litterStmt->bindParam(':id', $lastId);
            $litterStmt->execute();
            $litterData = $litterStmt->fetch(PDO::FETCH_OBJ);
            $litter = new Litter();
            $litter->fillFromStdClass($litterData);
            $puppyFemale->setLitter($litter);

            //Récupèration de la position
            $stmt_id = $this->pdo->connect()->prepare("SELECT id from puppies");
            $stmt_id->execute();
            $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
            if (empty($id_array)) {
                $position = 1;
            } else {
                $position = end($id_array)->id + 1 + $i + $this->getNumberMales();
            }
            $puppyFemale->setPosition($position);

            $puppyName = $puppyFemale->getName();
            $puppySex = 'femelle';
            $puppyColor = "Grise";
            $puppyDescription = '';
            $puppyAvailable = 'Disponible';
            $puppyEnable = 0;
            $puppyLitterId = $puppyFemale->getLitter()->getId();
            $puppyMainImg = '../../puppies_img/default.jpg';
            $puppyPosition = $puppyFemale->getPosition();

            $stmt = $this->pdo->connect()->prepare(createPuppy());
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

    /**
     * Get the value of enable
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set the value of enable
     *
     * @return  self
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get the value of position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
