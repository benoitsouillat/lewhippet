<?php
require_once(__DIR__ .  '/requestPDO.php');
$pdo = new RequestPDO();

// $stmt = $pdo->connect()->prepare("DROP DATABASE damoiseaux");
// $stmt->execute();

$stmt = $pdo->connect()->prepare("DROP TABLE IF EXISTS puppies, litters, repros, images, users");
$stmt->execute();
