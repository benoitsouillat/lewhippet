<?php

session_start();
require_once('../sql/repros_request.php');
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');

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
    } elseif (isset($_POST['repro_id']) && isset($_POST['repro_name'])) {
        $stmt = $conn->prepare(updateRepro());
        $stmt->bindValue(':id', $_POST['repro_id']);
        $stmt->bindValue(':name', $_POST['repro_name']);
        $stmt->bindValue(':sex', $_POST['repro_sex']);
        $stmt->bindValue(':color', $_POST['repro_color']);
        $stmt->bindValue(':insert', $_POST['repro_insert']);
        $stmt->bindValue(':breeder', $_POST['repro_breeder']);
        $stmt->bindValue(':birthdate', $_POST['repro_birthdate']);
        $stmt->bindValue(':lofselect', $_POST['repro_lofselect']);
        $stmt->bindValue(':adn', $_POST['repro_adn']);
        $stmt->bindValue(':champion', $_POST['repro_champion']);
        $stmt->bindValue(':description', $_POST['repro_description']);
        $stmt->bindValue(':main_img_path', 'default.jpg');

        try {
            $stmt->execute();
            header('Location:../repros.php');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    } elseif (isset($_GET['id'])) {
        require_once('../templates/repro_form.php');
    } elseif (isset($_POST) && isset($_POST['repro_name'])) {
        $stmt = $conn->prepare(createRepro());
        $stmt->bindValue(':name', $_POST['repro_name']);
        $stmt->bindValue(':sex', $_POST['repro_sex']);
        $stmt->bindValue(':color', $_POST['repro_color']);
        $stmt->bindValue(':insert', $_POST['repro_insert']);
        $stmt->bindValue(':breeder', $_POST['repro_breeder']);
        $stmt->bindValue(':birthdate', $_POST['repro_birthdate']);
        $stmt->bindValue(':lofselect', $_POST['repro_lofselect']);
        $stmt->bindValue(':adn', $_POST['repro_adn']);
        $stmt->bindValue(':champion', $_POST['repro_champion']);
        $stmt->bindValue(':description', $_POST['repro_description']);
        $stmt->bindValue(':main_img_path', 'default.jpg');

        try {
            $stmt->execute();
            header('Location:../repros.php');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        require_once('../templates/repro_form.php');
    }
} else {
    header('Location:../logout.php');
};
