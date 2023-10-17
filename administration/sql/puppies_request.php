<?php

function getAllPuppies()
{
    return "SELECT * FROM puppy_class";
};

function getAllPuppiesByPosition()
{
    return "SELECT * FROM puppy_class ORDER BY position";
};

function createPuppy()
{
    return "INSERT INTO `puppy_class` (name, sex, available, description, main_img_path, mother_name, mother_adn, mother_champion, position) VALUES (:name, :sex, :available, :description, :main_img_path, :mother_name, :mother_adn, :mother_champion, :position)";
}

function updatePuppy()
{
    return "UPDATE `puppy_class` SET name = :name, sex = :sex, available = :available, description = :description, main_img_path = :main_img_path, mother_name = :mother_name, mother_adn = :mother_adn, mother_champion = :mother_champion WHERE id = :id";
}
function updatePuppyPosition()
{
    return "UPDATE `puppy_class` SET position = :position WHERE id = :id";
}

function deletePuppy()
{
    return "DELETE FROM `puppy_class` WHERE `id` = :id";
}

function getPuppyFromId()
{
    return "SELECT * FROM puppy_class WHERE `id` = :id";
}

function savePuppyImages()
{
    return "INSERT INTO images (dog_id, path) VALUES (:dogId, :path)";
}
function getAllPuppyImages()
{
    return "SELECT * FROM `images`";
}

function getPuppyImages()
{
    return "SELECT * FROM images WHERE `dog_id` = :dogId";
}
function togglePuppy()
{
    return "UPDATE `puppy_class` SET `enable` = :enable WHERE id = :id";
}