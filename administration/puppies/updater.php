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

// Vérification que la position entrée ne dépasse pas l'id maximum


if (isset($_GET['moveBefore'])) {
} elseif (isset($_GET['moveAfter'])) {
} elseif (isset($_GET['idInputer'])) {
    $newId = $_GET['idInputer'];
} else {
    echo 'Une erreur s\'est produite';
    die();
}
die();
