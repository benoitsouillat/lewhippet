<?php

session_start();
require_once('../sql/repros_request.php');
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');
require_once('../classes/Repro.php');

$repro = new Repro('', '', '', '', '', '', '', '', '', '', '');
$repro->setBirthdate(date('Y-m-d'));
if (check_session_start($_SESSION)) {

    if (isset($_GET['delete']) && $_GET['delete'] == true) {
        $stmt = $conn->prepare(deleteRepro());
        $stmt->bindParam(':id', $_GET['id']);
        try {
            $stmt->execute();
            header('Location:../repros.php');
        } catch (PDOException $e) {
            echo 'Une erreur s\'est produite : ' . $e->getMessage();
        }
    }
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare(getReproFromId());
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $reproData = $stmt->fetch(PDO::FETCH_OBJ);
        $repro->fillFromStdClass($reproData);
        include_once('../templates/repro_form.php');
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $repro->setName($_POST['repro_name']);
        $repro->setSex($_POST['repro_sex']);
        $repro->setColor($_POST['repro_color']);
        $repro->setInsert($_POST['repro_insert']);
        $repro->setDescription($_POST['repro_description']);
        $repro->setBirthdate($_POST['repro_birthdate']);
        $repro->setBreeder($_POST['repro_breeder']);
        $repro->setLofselect($_POST['repro_lofselect']);
        $repro->setIsAdn($_POST['repro_adn']);
        $repro->setIsChampion($_POST['repro_champion']);

        if (isset($_POST['repro_id'])) {
            $stmt = $conn->prepare(updateRepro());
            $stmt->bindValue(':id', $_POST['repro_id']);
        } else {
            $stmt = $conn->prepare(createRepro());
        }
        try {
            $stmt->bindValue(':name', $repro->getName());
            $stmt->bindValue(':sex', $repro->getSex());
            $stmt->bindValue(':color', $repro->getColor());
            $stmt->bindValue(':insert', $repro->getInsert());
            $stmt->bindValue(':description', $repro->getDescription());
            $stmt->bindValue(':breeder', $repro->getBreeder());
            $stmt->bindValue(':birthdate', $repro->getBirthdate());
            $stmt->bindValue(':lofselect', $repro->getLofselect());
            $stmt->bindValue(':adn', $repro->getIsAdn());
            $stmt->bindValue(':champion', $repro->getIsChampion());
            $stmt->bindValue(':main_img_path', 'default.jpg');
            $stmt->execute();
            header('Location:../repros.php');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        include_once('../templates/repro_form.php');
    }
} else {
    header('Location:../logout.php');
};
