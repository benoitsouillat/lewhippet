<?php

function getAllRepros()
{
    return "SELECT * FROM repros";
}

function getReproFromId()
{
    return "SELECT * FROM repros WHERE `id` = :id";
}

function getAllMales()
{
    return "SELECT * FROM repros WHERE sex = 'male'";
}

function createRepro()
{
    return "INSERT INTO `repros` (name, sex, color, `insert`, breeder, birth_date, lofselect_link, is_adn, is_champion, description, main_img_path) VALUES (:name, :sex, :color, :insert, :breeder, :birthdate, :lofselect, :adn, :champion, :description, :main_img_path)";
}

function updateRepro()
{
    return "UPDATE `repros` SET name = :name, sex = :sex, color = :color, `insert` = :insert, description = :description, main_img_path = :main_img_path, breeder = :breeder, birth_date = :birthdate, lofselect_link = :lofselect, is_adn = :adn, is_champion = :champion WHERE id = :id";
}

function deleteRepro()
{
    return "DELETE FROM `repros` WHERE `id` = :id";
}
function saveReproImages()
{
    return "INSERT INTO images (repro_id, path) VALUES (:reproId, :path)";
}

function getReproImages()
{
    return "SELECT * FROM images WHERE `repro_id` = :reproId";
}