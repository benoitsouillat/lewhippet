<?php

//Mettre le logo de la Romance des Damoiseaux
define('DEFAULT_PUPPY_PATH_IMG', '../../puppies_img/default.jpg');
require_once('../sql/puppies_request.php');
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');



if (isset($_GET['id'])) {
    // Delete
    if (isset($_GET['delete']) && ($_GET['delete'] == true)) {
        $id = $_GET['id'];
        $stmt = $conn->prepare(deletePuppy($id));
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            header("Location:../puppies.php");
        } catch (PDOException $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
    // Modify
    $id = $_GET['id'];
    $stmt = $conn->prepare(getPuppyFromId($id));
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    try {
        $puppy = $stmt->fetch(PDO::FETCH_OBJ);
        include('../templates/puppy_form.php');
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} elseif (isset($_POST['name']) && $_POST['name'] != null && isset($_POST['puppy_id'])) {
    $puppy = $_POST;

    $stmt = $conn->prepare(updatePuppy());
    $stmt->bindParam(':id', $puppy['puppy_id']);
    $stmt->bindParam(':name', $puppy['name']);
    $stmt->bindParam(':sex', $puppy['sex']);
    $stmt->bindParam(':available', $puppy['available']);
    $stmt->bindParam(':description', $puppy['description']);
    $file_name = $puppy['name'] . $puppy['sex'];
    $file_destination = '';

    if (isset($_FILES['main_img_path'])) {
        //IL FAUT GERER LES IDS SUR LES NOM DE FICHIERS
        $file_tmp = $_FILES['main_img_path']['tmp_name'];
        $file_destination = '../../puppies_img/' . str_replace(' ', '', $file_name) . '.jpg';
        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo "L'image a été enregistrée avec succès.";
        }
    }
    $stmt->bindValue(':main_img_path',  $file_destination);

    try {
        $stmt->execute();
        header('Location:../puppies.php');
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
// Create
elseif (isset($_POST['name'])) {

    $puppy = $_POST;
    $stmt = $conn->prepare(createPuppy());
    $stmt->bindParam(':name', $puppy['name']);
    $stmt->bindParam(':sex', $puppy['sex']);
    $stmt->bindParam(':available', $puppy['available']);
    $stmt->bindParam(':description', $puppy['description']);

    $file_name = $puppy['name'] . $puppy['sex'];
    $file_destination = '';

    if (isset($_FILES['main_img_path'])) {
        //IL FAUT GERER LES IDS SUR LES NOM DE FICHIERS
        $file_tmp = $_FILES['main_img_path']['tmp_name'];
        $file_destination = '../../puppies_img/' . str_replace(' ', '', $file_name) . '.jpg';
        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo "L'image a été enregistrée avec succès.";
        }
    }
    $stmt->bindValue(':main_img_path', $file_destination);

    try {
        $stmt->execute();
        header('Location:../puppies.php');
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
} else {
    include_once('../templates/puppy_form.php');
}
