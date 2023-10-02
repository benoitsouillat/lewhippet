<?php

session_start();
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');
require_once('../sql/repros_request.php');
//require_once('../sql/litters_request.php');
require_once('../classes/Repro.php');
require_once('../classes/Litter.php');

if (check_session_start($_SESSION)) {
    $stmt = $conn->prepare(getAllMales());
    $stmt->execute();
    $reprosMales = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $litter = new Litter(
        null,
        null,
        null,
        7,
        3,
        '2023-2023'
    );

    if (isset($_GET['id']) && $_GET['id'] != 0) {
        $stmt = $conn->prepare(getReproFromId());
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $motherReproData = $stmt->fetch(PDO::FETCH_OBJ);
        $motherRepro = new Repro('', '', '', '', '', '', '', '', '', '', '');
        $motherRepro->fillFromStdClass($motherReproData);
        $litter->setMother($motherRepro);
    }

    include_once('../templates/litter_form.php');
} else {
    header('Location:../logout.php');
}
