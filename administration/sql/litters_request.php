<?php

function getAllLitters()
{
    return "SELECT * FROM `litters`";
}
function getLitterFromId()
{
    return "SELECT * FROM litters WHERE `id` = :id";
}
function createLitter()
{
    return "INSERT INTO `litters` (name, sex, color, `insert`, breeder, birth_date, lofselect_link, is_adn, is_champion, description, main_img_path) VALUES (:name, :sex, :color, :insert, :breeder, :birthdate, :lofselect, :adn, :champion, :description, :main_img_path)";
}

function updateLitter()
{
    return "UPDATE `litters` SET name = :name, sex = :sex, color = :color, `insert` = :insert, description = :description, main_img_path = :main_img_path, breeder = :breeder, birth_date = :birthdate, lofselect_link = :lofselect, is_adn = :adn, is_champion = :champion WHERE id = :id";
}

function deleteLitter()
{
    return "DELETE FROM `litters` WHERE `id` = :id";
}