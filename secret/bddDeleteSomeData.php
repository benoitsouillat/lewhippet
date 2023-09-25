<?php
require_once(__DIR__ . "/connexion.php"); // PDO FILE returning an instance name $conn
require_once(__DIR__ . "/../administration/sql/puppies_request.php");

for ($i = 0; $i < 2; $i++) {
    $stmt = $conn->prepare("SELECT id from puppies");
    $stmt->execute();
    $idArray = $stmt->fetchAll(PDO::FETCH_OBJ);
    $id = end($idArray)->id;

    $stmt = $conn->prepare(deletePuppy($id));
    $stmt->bindParam(':id', $id);
    try {
        $stmt->execute();
    } catch (PDOException $error) {
        var_dump($error);
    }
}

$stmt = $conn->prepare("SELECT id from puppies");
$stmt->execute();
$idArray = $stmt->fetchAll(PDO::FETCH_OBJ);
$id = end($idArray)->id;

$stmt = $conn->prepare(deletePuppy($id));
$stmt->bindParam(':id', $id);
try {
    $stmt->execute();
} catch (PDOException $error) {
    var_dump($error);
}