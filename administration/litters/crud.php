<?php

session_start();
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');
require_once('../sql/repros_request.php');
require_once('../sql/litters_request.php');
require_once('../classes/Repro.php');
require_once('../classes/Litter.php');

if (check_session_start($_SESSION)) {

    if (isset($_GET['delete']) && $_GET['delete'] == true) {
        try {
            $stmt = $conn->prepare(deleteLitter());
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            header('Location:../litters.php');
        } catch (PDOException $e) {
            echo 'Une erreur s\'est produite ' . $e->getMessage();
        }
    }
    $litter = new Litter();

    if (isset($_GET['repro_id']) && $_GET['repro_id'] != 0) {
        $getReproId = $_GET['repro_id'];
        $motherRepro = new Repro();
        $motherRepro->fetchFromDatabase($getReproId);
        $litter->setMother($motherRepro);

        $stmt = $conn->prepare(getAllMales());
        $stmt->execute();
        $reprosMales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_GET['id'])) {
        $stmt = $conn->prepare(getLitterFromId());
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $litterData = $stmt->fetch(PDO::FETCH_OBJ);
        $litter->fillFromStdClass($litterData);
        include_once('../templates/litter_modify_form.php');
    } else {
        include_once('../templates/litter_form.php');
    }

    if (isset($_POST) && isset($_POST['mother_id'])) {
        $mother = new Repro();
        $mother->fetchFromDatabase($_POST['mother_id']);
        $litter->setMother($mother);
        $father = new Repro();
        $father->fetchFromDatabase(intval($_POST['father']));
        $litter->setFather($father);
        $litter->setBirthdate($_POST['birthdate']);
        $litter->setNumberPuppies($_POST['numberPuppies']);
        $litter->setNumberMales($_POST['numberMales']);
        $litter->setNumberFemales($litter->getNumberPuppies() - $litter->getNumberMales());
        $litter->setLitterNumberSCC($_POST['sccNumber']);
        try {
            $stmt = $conn->prepare(createLitter());
            $stmt->bindValue(':birthdate', $litter->getBirthdate());
            $stmt->bindValue(':mother_id', $litter->getMother()->getId());
            $stmt->bindValue(':father_id', $litter->getFather()->getId());
            $stmt->bindValue(':numberPuppies', $litter->getNumberPuppies());
            $stmt->bindValue(':numberMales', $litter->getNumberMales());
            $stmt->bindValue(':numberFemales', $litter->getNumberFemales());
            $stmt->bindValue(':litterNumberSCC', $litter->getLitterNumberSCC());
            $stmt->execute();
            header('Location:../litters.php');
        } catch (PDOException $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
} else {
    header('Location:../logout.php');
}