<?php

session_start();
require_once('../sql/repros_request.php');
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');
require_once('../classes/Repro.php');

$repro = new Repro();
$repro->setBirthdate(date('Y-m-d'));
$repro->setLofselect('https://www.centrale-canine.fr/lofselect/recherche-chien');
if (check_session_start($_SESSION)) {
    $_SESSION['error'] = [];
    if (isset($_GET['delete']) && $_GET['delete'] == true) {
        try {
            $stmt = $conn->prepare(deleteRepro());
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            header('Location:../repros.php');
        } catch (PDOException $e) {
            $_SESSION['error'][] = intval($e->getCode(), 10);
            if ($e->getCode() == 23000) {
                header('Location:../repros.php');
            } else {
                echo 'Une erreur s\'est produite : ' . $e->getMessage();
            }
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
        // Système pour enregistrer des images dans la table Images pour créer un diaporama pour les reproducteurs
        if (isset($_FILES['repro_multi_images']) && $_FILES['repro_multi_images']['name'][0] !== NULL) {
            var_dump($_FILES['repro_multi_images']['tmp_name']);
            $imagesUploadedTmp = $_FILES['repro_multi_images']['tmp_name'];
            foreach ($imagesUploadedTmp as $imageTmpName) {
                $prefix = substr($imageTmpName, -8, -4);
                $destination = '../../repros_img/' . $_POST['repro_id'] . '-' . $prefix . '.jpg';
                move_uploaded_file($imageTmpName, $destination);
                $stmt = $conn->prepare(saveReproImages());
                $stmt->bindParam(':reproId', $_POST['repro_id']);
                $stmt->bindParam(':path', $destination);
                $stmt->execute();
            }
        }
        // Récupération de l'id s'il est envoyé ou création d'un ID +1 depuis la table Repros
        if ($_POST['repro_id']) {
            $reproId = $_POST['repro_id'];
            $repro->setMainImgPath($_POST['repro_img']);
        } else {
            $stmt_id = $conn->prepare("SELECT id from repros");
            $stmt_id->execute();
            $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
            $reproId = end($id_array)->id + 1;
        }

        $file_destination = $repro->getMainImgPath();
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

        // Condition : Si un fichier Main_Img_Path est envoyé via le formulaire
        if (isset($_FILES['main_img_path']) && $_FILES['main_img_path']['name'] !== null && $_FILES['main_img_path']['size'] > 0) {
            $file_name = $reproId . '-' . $repro->getName();
            $file_tmp = $_FILES['main_img_path']['tmp_name'];
            $file_destination = '../../repros_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            move_uploaded_file($file_tmp, $file_destination);
            $repro->setMainImgPath($file_destination);
        }

        // Modification du reproducteur si son ID est transmis, ou création d'un nouveau
        if (isset($_POST['repro_id'])) {
            $stmt = $conn->prepare(updateRepro());
            $stmt->bindValue(':id', $_POST['repro_id']);
        } else {
            $stmt = $conn->prepare(createRepro());
        }
        // Bind Value avant Fetch sur la base de donnée depuis l'entité Class::Repro via les méthodes de l'objet
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
            $stmt->bindValue(':main_img_path', $repro->getMainImgPath());
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
