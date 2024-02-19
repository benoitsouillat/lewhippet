<?php

require_once(__DIR__ . '/requestPDO.php');
require_once(__DIR__ . '/../administration/classes/Repro.php');
require_once(__DIR__ . '/../administration/classes/Litter.php');
require_once(__DIR__ . '/../administration/classes/Puppy.php');
require_once(__DIR__ . '/../administration/sql/users_request.php');
require_once(__DIR__ . '/../administration/sql/repros_request.php');
require_once(__DIR__ . '/../administration/sql/litters_request.php');
require_once(__DIR__ . '/../administration/sql/puppies_request.php');

$pdo = new RequestPDO();
$admin_email = 'admin@email.fr';
$admin_password = password_hash('password', PASSWORD_BCRYPT);
$stmt = $pdo->connect()->prepare(addUser());
$stmt->bindValue(':email', $admin_email);
$stmt->bindValue(':password', $admin_password);
$stmt->bindValue(':img_profile_path', '../user_img/default.jpg');
$stmt->execute();

$admin_id = 1; // Valeur arbitraire pour les tests Docker -- Le dossier database ne doit pas être modifié sur le serveur
$stmt = $pdo->connect()->prepare(setUserRole());
$stmt->bindValue(':id', $admin_id);
$stmt->bindValue(':role', 'Admin');
$stmt->execute();

$father = new Repro(
    'Uppercut',
    'male',
    'Bringé Bleueté',
    '../assets/logo/Noir.png',
    '256261589632569',
    'Joli mâle plein d\'amour',
    'de la Romance des Damoiseaux',
    '2023-01-09',
    '#',
    1,
    1
);
$mother = new Repro(
    'Une petite Romance',
    'femelle',
    'Bleu et blanc',
    '../images/naissance_tetee_precieuse.jpg',
    '250268978956956',
    'Très gentille',
    'de la Romance des Damoiseaux',
    '2025-05-05',
    '#',
    1,
    1
);
$josette = new Repro(
    'Josette',
    'femelle',
    'Blanche',
    '../images/naissance_tetee_precieuse.jpg',
    '250268978956956',
    'Bientôt maman',
    'de la Romance des Damoiseaux',
    '2020-02-05',
    '#',
    1,
    1
);

$father->fetchToDatabase();
$mother->fetchToDatabase();
$josette->fetchToDatabase();
$father->setId(2);
$mother->setId(1);
$litter = new Litter(
    '2025-09-08',
    $father,
    $mother,
    5,
    2,
    '2525-69-998565',
    true
);

$litter->fetchToDatabase();
$litter->generatePuppiesMales();
$litter->generatePuppiesFemales();
