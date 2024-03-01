<?php
require_once(__DIR__ .  '/requestPDO.php');

$pdo = new RequestPDO();

$database = "CREATE DATABASE IF NOT EXISTS `damoiseaux`";

$table_users = "CREATE TABLE  IF NOT EXISTS `damoiseaux`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `email` VARCHAR(50) NOT NULL, 
    `password` VARCHAR(255) NOT NULL, 
    `img_profile_path` VARCHAR(255) NOT NULL, 
    `role` VARCHAR(15) NOT NULL DEFAULT 'User',
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

$table_repros = "CREATE TABLE  IF NOT EXISTS `damoiseaux`.`repros` (
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

$table_litters = "CREATE TABLE  IF NOT EXISTS `damoiseaux`.`litters` (
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

$table_puppies = "CREATE TABLE  IF NOT EXISTS `damoiseaux`.`puppies` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `name` VARCHAR(50) NOT NULL, 
    `sex` VARCHAR(10) NOT NULL, 
    `color` VARCHAR(50) NOT NULL DEFAULT 'Gris',
    `available` VARCHAR(20) NOT NULL, 
    `description` VARCHAR(255), 
    `main_img_path` VARCHAR(255) NOT NULL, 
    `mother_name` VARCHAR(50),
    `mother_adn` TINYINT(1) NOT NULL DEFAULT TRUE,
    `mother_champion` TINYINT(1) NOT NULL DEFAULT FALSE,
    `position` INT NOT NULL,
    `enable` BOOLEAN NOT NULL DEFAULT TRUE,
    `Litter` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`Litter`) REFERENCES `litters`(`id`)) ENGINE = InnoDB;";


$table_images = "CREATE TABLE  IF NOT EXISTS `damoiseaux`.`images` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `dog_id` INT NOT NULL ,
    `path` VARCHAR(255) NOT NULL DEFAULT 'default.jpg',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`dog_id`) REFERENCES `puppies`(`id`)) ENGINE = InnoDB;";
// Permet de supprimer une portée en cas de suppression d'un reproducteur -- RESTRICT est mieux pour protéger des erreurs
$table_litter_foreign_key = "ALTER TABLE `litters` DROP FOREIGN KEY `litters_ibfk_1`; ALTER TABLE `litters` ADD CONSTRAINT `litters_ibfk_1` FOREIGN KEY (`mother_id`) REFERENCES `repros`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT; ALTER TABLE `litters` DROP FOREIGN KEY `litters_ibfk_2`; ALTER TABLE `litters` ADD CONSTRAINT `litters_ibfk_2` FOREIGN KEY (`father_id`) REFERENCES `repros`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;";

$table_news = "CREATE TABLE IF NOT EXISTS `damoiseaux`.`news` (
    `news_id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `display` BOOLEAN NOT NULL DEFAULT TRUE,
    `image` VARCHAR(255) NOT NULL DEFAULT '',
    `created_at` DATE NOT NULL DEFAULT '2024-01-01',
    PRIMARY KEY (`news_id`)) ENGINE = InnoDB;";

$pdo->connect()->exec($database);
$pdo->connect()->exec($table_users);
$pdo->connect()->exec($table_repros);
$pdo->connect()->exec($table_litters);
$pdo->connect()->exec($table_puppies);
$pdo->connect()->exec($table_images);
$pdo->connect()->exec($table_news);
