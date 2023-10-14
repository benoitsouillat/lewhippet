<?php

require_once('../../secret/connexion.php');
require_once('../sql/puppies_request.php');

$puppyId = $_GET['puppyId'];
$stmt = $conn->prepare(getAllPuppies());
$stmt->execute();
$dataPuppies = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $conn->prepare(getPuppyFromId());
$stmt->bindParam(':id', $puppyId);
$stmt->execute();
$puppyWillBeChange = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $conn->prepare(updatePuppyPosition());
$stmt->bindParam(':id', $puppyId);


if (isset($_GET['positionInputer']) && $_GET['positionInputer'] != $puppyWillBeChange['position']) {
    $newPosition = $_GET['positionInputer'];
    $stmt->bindParam(':position', $newPosition);
    try {
        $stmt->execute();
        header('Location: ../puppies.php');
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} elseif (isset($_GET['moveBefore'])) {
    $newPosition = $puppyWillBeChange['position'] - 1;
    $stmt->bindParam(':position', $newPosition);
    try {
        $stmt->execute();
        header('Location: ../puppies.php');
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} elseif (isset($_GET['moveAfter'])) {
    $newPosition = $puppyWillBeChange['position'] + 1;
    $stmt->bindParam(':position', $newPosition);
    try {
        $stmt->execute();
        header('Location: ../puppies.php');
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} elseif (isset($_GET['positionInputer']) && $_GET['positionInputer'] == $puppyWillBeChange['position']) {
    header('Location: ../puppies.php');
} elseif (isset($_GET['enable'])) {
    $stmtToggler = $conn->prepare(togglePuppy());
    $stmtToggler->bindParam(':id', $puppyId);
    $stmtToggler->bindParam(':enable', $_GET['enable']);
    try {
        $stmtToggler->execute();
        header('Location:../puppies.php');
    } catch (PDOException $e) {
        echo 'Une erreur : ' . $e;
    }
} else {
    echo 'Une erreur s\'est produite - Contactez l\'administrateur du site';
    die();
}
