<?php

// require_once('../../secret/connexion.php');
require_once('../sql/litters_request.php');
require_once(__DIR__ . '/../../database/requestPDO.php');

$pdo = new RequestPDO();

$litterId = $_GET['litterId'];
$stmt = $pdo->connect()->prepare(getAllLitters());
$stmt->execute();
$dataLitters = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->connect()->prepare(getlitterFromId());
$stmt->bindParam(':id', $litterId);
$stmt->execute();
$litterWillBeChange = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->bindParam(':id', $litterId);


if (isset($_GET['enable'])) {
    $stmtToggler = $pdo->connect()->prepare(toggleLitter());
    $stmtToggler->bindParam(':id', $litterId);
    $stmtToggler->bindParam(':enable', $_GET['enable']);
    try {
        $stmtToggler->execute();
        header('Location:../litters.php');
    } catch (PDOException $e) {
        echo 'Une erreur : ' . $e;
    }
} else {
    echo 'Une erreur s\'est produite - Contactez l\'administrateur du site';
    die();
}