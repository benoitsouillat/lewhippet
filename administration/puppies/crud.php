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
    $stmt->bindValue(':id', $id);
    try {
        $puppy = $stmt->execute();
        echo "Voici " . $puppy['name'];
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
    echo "Nous allons modifier => " . $id;
    // Get Template de la page d'administration

    // Affichage du formulaire pré-rempli avec les données de $get['id']
}
// Create
else {
    echo "Il faut créer un nouveau chiot";
}