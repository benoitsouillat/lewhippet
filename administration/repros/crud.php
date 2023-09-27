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
    }
}
