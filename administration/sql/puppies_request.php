<?php

function getAllPuppies()
{
    return "SELECT * FROM puppies";
};

function createPuppy()
{
    return "INSERT INTO `puppies` (name, sex, available, description, main_img_path, mother_name, mother_adn, mother_champion) VALUES (:name, :sex, :available, :description, :main_img_path, :mother_name, :mother_adn, :mother_champion)";
}

function updatePuppy()
{
    return "UPDATE `puppies` SET name = :name, sex = :sex, available = :available, description = :description, main_img_path = :main_img_path, mother_name = :mother_name, mother_adn = :mother_adn, mother_champion = :mother_champion WHERE id = :id";
}

function deletePuppy()
{
    return "DELETE FROM `puppies` WHERE `id` = :id";
}

function getPuppyFromId()
{
    return "SELECT * FROM puppies WHERE `id` = :id";
}
