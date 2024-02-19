<?php

require_once('../../secret/connexion.php');
require_once('../../administration/sql/puppies_request.php');

$stmt = $conn->prepare(deletePuppyImage());
$stmt->bindParam('imageId', $_GET['id']);
try {
    $stmt->execute();
    header("Location:../puppies/crud.php?id={$_GET['puppy_id']}");
} catch (PDOException $e) {
    "Une erreur s'est produite lors de la suppression de l'image : " . $e;
    echo "<a href='../gerance.php'>Retour à la gestion</a>";
}
