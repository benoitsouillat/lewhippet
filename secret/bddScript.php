<?php

require_once(__DIR__ . "/connexion.php"); // PDO FILE returning an instance name $conn

$table_users = "CREATE TABLE `damoiseaux_php`.`users` (`id` INT NOT NULL AUTO_INCREMENT, `email` VARCHAR(50) NOT NULL, `password` VARCHAR(255) NOT NULL, `img_profile_path` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$table_puppies = "CREATE TABLE `damoiseaux_php`.`puppies` (`id` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR(50) NOT NULL, `sex` VARCHAR(10) NOT NULL, `available` VARCHAR(20) NOT NULL, `description` VARCHAR(255), `main_img_path` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";


//$conn->exec($table_users);
//$conn->exec($table_puppies);

/* Insertion des données de test */
/* PUPPIES */
/*
function random_status()
{
    $rand = rand(1, 3);
    if ($rand === 1) {
        return 'Disponible';
    } else if ($rand === 3) {
        return 'En option';
    } else {
        return 'Réservé';
    }
}
function random_sex()
{
    $rand = rand(1, 2);
    if ($rand === 1) {
        return 'femelle';
    } else {
        return 'male';
    }
}

$path_img = "../puppies_img/default.jpg";

for ($i = 0; $i < 3; $i++) {
    $rand_status = random_status();
    $rand_sex = random_sex();

    $test_puppies = "INSERT INTO `puppies` (name, sex, available, description, main_img_path) VALUES ('Jean', '$rand_sex', '$rand_status', 'Ceci est une description !!' , '$path_img')";
    $conn->exec($test_puppies);
}

$rand_status = random_status();
$rand_sex = random_sex();

*/

/* USERS / ADMINISTRATORS */


$test_administrator = "INSERT INTO `users` (email, password, img_profile_path, role) VALUES ('benoit.souillat@gmail.com', '', 'none', 'Admin')";
$conn->exec($test_administrator);