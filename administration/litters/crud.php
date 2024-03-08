<?php

session_start();
require_once('../utilities/usefull_functions.php');
// require_once('../../secret/connexion.php');
require_once('../sql/repros_request.php');
require_once('../sql/litters_request.php');
require_once('../classes/Repro.php');
require_once('../classes/Litter.php');
require_once(__DIR__ . '/../../database/requestPDO.php');


if (check_session_start($_SESSION)) {
    $_SESSION['error'] = [];
    $pdo = new RequestPDO();
    if (isset($_GET['delete']) && $_GET['delete'] == true) {
        try {
            $stmt = $pdo->connect()->prepare(deleteLitter());
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            header('Location:../litters.php');
        } catch (PDOException $e) {
            $_SESSION['error'][] = intval($e->getCode(), 10);
            if ($e->getCode() == 23000) {
                header('Location:../litters.php');
            } else {
                echo 'Une erreur s\'est produite : ' . $e->getMessage();
            }
        }
    }

    $litter = new Litter();

    if (isset($_GET['repro_id']) && $_GET['repro_id'] != 0) {
        $getReproId = $_GET['repro_id'];
        $motherRepro = new Repro();
        $motherRepro->fetchFromDatabase($getReproId);
        $litter->setMother($motherRepro);

        $stmt = $pdo->connect()->prepare(getAllMales());
        $stmt->execute();
        $reprosMales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if (isset($_GET['id'])) {
        $stmt = $pdo->connect()->prepare(getLitterFromId());
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $litterData = $stmt->fetch(PDO::FETCH_OBJ);
        $litter->fillFromStdClass($litterData);
        $litter->setLitterNumberSCC($litterData->litter_number);
        include_once('../templates/litter_modify_form.php');
    } elseif (isset($_POST) && isset($_POST['mother_id'])) {
        $mother = new Repro();
        $mother->fetchFromDatabase($_POST['mother_id']);
        $litter->setMother($mother);
        $father = new Repro();
        $father->fetchFromDatabase(intval($_POST['father_id']));
        $litter->setFather($father);
        $litter->setBirthdate($_POST['birthdate']);
        if (isset($_POST['numberFemales'])) {
            $litter->setNumberFemales($_POST['numberFemales']);
            $litter->setNumberMales($_POST['numberMales']);
        }
        $litter->setNumberPuppies($litter->getNumberFemales() + $litter->getNumberMales());
        $litter->setLitterNumberSCC($_POST['sccNumber']);
        if (isset($_POST['litter_id'])) {
            $stmt = $pdo->connect()->prepare(updateLitter());
            $stmt->bindValue(':id', $_POST['litter_id']); //Use GetId() ?
        } else {
            $stmt = $pdo->connect()->prepare(createLitter());
        }
        try {
            $stmt->bindValue(':birthdate', $litter->getBirthdate());
            $stmt->bindValue(':mother_id', $litter->getMother()->getId());
            $stmt->bindValue(':father_id', $litter->getFather()->getId());
            $stmt->bindValue(':numberPuppies', $litter->getNumberPuppies());
            $stmt->bindValue(':numberMales', $litter->getNumberMales());
            $stmt->bindValue(':numberFemales', $litter->getNumberFemales());
            $stmt->bindValue(':litterNumberSCC', $litter->getLitterNumberSCC());
            $stmt->bindValue(':position', $litter->getPosition());
            $stmt->execute();
            if (!isset($_POST['litter_id'])) {
                $litter->generatePuppiesMales();
                $litter->generatePuppiesFemales();
            }
            header('Location:../litters.php');
        } catch (PDOException $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    } else {
        include_once('../templates/litter_form.php');
    }
} else {
    header('Location:../logout.php');
}
