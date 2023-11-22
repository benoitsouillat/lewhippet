<?php

require_once(__DIR__ . "/connexion.php"); // PDO FILE returning an instance name $conn

$database = "CREATE DATABASE IF NOT EXISTS `damoiseaux_php`";

$table_users = "CREATE TABLE `damoiseaux_php`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `email` VARCHAR(50) NOT NULL, 
    `password` VARCHAR(255) NOT NULL, 
    `img_profile_path` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$table_puppies = "CREATE TABLE `damoiseaux_php`.`puppies` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `name` VARCHAR(50) NOT NULL, 
    `sex` VARCHAR(10) NOT NULL, 
    `available` VARCHAR(20) NOT NULL, 
    `description` VARCHAR(255), 
    `main_img_path` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$table_users_add_roles = "ALTER TABLE `users` ADD `role` VARCHAR(15) NOT NULL DEFAULT 'User' AFTER `img_profile_path`;";
$table_puppies_add_mother = "ALTER TABLE `puppies` ADD `mother_name` VARCHAR(255) NOT NULL AFTER `main_img_path`, ADD `mother_adn` BOOLEAN NOT NULL DEFAULT TRUE AFTER `mother_name`, ADD `mother_champion` BOOLEAN NOT NULL DEFAULT FALSE AFTER `mother_adn`";
$table_puppies_add_position = "ALTER TABLE `puppies` ADD `position` INT NOT NULL AFTER `mother_champion`;";
$table_images = "CREATE TABLE `damoiseaux_php`.`images` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `dog_id` INT NOT NULL ,
        `path` VARCHAR(255) NOT NULL DEFAULT 'default.jpg',
        PRIMARY KEY (`id`),
        FOREIGN KEY (`dog_id`) REFERENCES `puppies`(`id`)) ENGINE = InnoDB;";
$table_puppy_add_enable = "ALTER TABLE `puppies` ADD `enable` BOOLEAN NOT NULL DEFAULT TRUE AFTER `position` ";
$table_repros = "CREATE TABLE `damoiseaux_php`.`repros` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `sex` VARCHAR(10) NOT NULL DEFAULT 'Femelle',
    `color` VARCHAR(50) NOT NULL DEFAULT 'Bringée bleu',
    `insert` VARCHAR(255) NOT NULL DEFAULT '',
    `breeder` VARCHAR(255) NOT NULL DEFAULT 'de la Romance des Damoiseaux',
    `breed` VARCHAR(50) NOT NULL DEFAULT 'Whippet',
    `birth_date` DATE NOT NULL DEFAULT '1988-01-01',
    `lofselect_link` VARCHAR(255) DEFAULT '',
    `is_adn` BOOLEAN NOT NULL DEFAULT TRUE,
    `is_champion`  BOOLEAN NOT NULL DEFAULT FALSE,
    `main_img_path` VARCHAR(255) DEFAULT 'default.jpg',
    `description` VARCHAR(255),
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$table_litters = "CREATE TABLE `damoiseaux_php`.`litters` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `birthdate` DATE NOT NULL DEFAULT '2023-01-01',
    `mother_id` INT,
    `father_id` INT,
    `number_of_puppies` INT NOT NULL, 
    `number_of_males` INT, 
    `number_of_females` INT,
    `litter_number` VARCHAR(255) NOT NULL,
    `enable` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`mother_id`) REFERENCES `repros`(`id`),
    FOREIGN KEY (`father_id`) REFERENCES `repros`(`id`)) 
    ENGINE = InnoDB;";


// Permet de supprimer une portée en cas de suppression d'un reproducteur -- RESTRICT est mieux pour protéger des erreurs
$table_litter_foreign_key = "ALTER TABLE `litters` DROP FOREIGN KEY `litters_ibfk_1`; ALTER TABLE `litters` ADD CONSTRAINT `litters_ibfk_1` FOREIGN KEY (`mother_id`) REFERENCES `repros`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT; ALTER TABLE `litters` DROP FOREIGN KEY `litters_ibfk_2`; ALTER TABLE `litters` ADD CONSTRAINT `litters_ibfk_2` FOREIGN KEY (`father_id`) REFERENCES `repros`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;";

//$conn->exec($database);
// //$conn->exec($table_users);
// //$conn->exec($table_puppies);
// //$conn->exec($table_users_add_roles);
// //$conn->exec($table_puppies_add_mother);
// $conn->exec($table_images);
$conn->exec($table_puppy_add_enable);
//$conn->exec($table_repros);
$conn->exec($table_litters);



/* Insertion des données de test */
/* PUPPIES */

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

/* for ($i = 0; $i < 3; $i++) {
    $rand_status = random_status();
    $rand_sex = random_sex();

    $test_puppies = "INSERT INTO `puppies` (name, sex, available, description, main_img_path) VALUES ('Jean', '$rand_sex', '$rand_status', 'Ceci est une description !!' , '$path_img')";
    $conn->exec($test_puppies);
} */