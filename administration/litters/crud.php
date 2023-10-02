<?php

session_start();
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');
require_once('../sql/repros_request.php');
//require_once('../sql/litters_request.php');
require_once('../classes/Repro.php');
require_once('../classes/Litter.php');

$stmt = $conn->prepare(getAllMales());
$stmt->execute();
$reprosMales = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $conn->prepare(getReproFromId());
$stmt->bindValue(':id', 3);
$stmt->execute();
$motherReproData = $stmt->fetch(PDO::FETCH_OBJ);
$motherRepro = new Repro('', '', '', '', '', '', '', '', '', '', '');
$motherRepro->fillFromStdClass($motherReproData);



$litter = new Litter(
    '2021-03-18',
    $motherRepro,
    $motherRepro,
    7,
    3,
    '2023-2023'
);
include_once('../templates/litter_form.php');
