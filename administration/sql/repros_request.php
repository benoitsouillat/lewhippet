<?php

function getAllRepros()
{
    return "SELECT * FROM repros";
};

function getAllreprosByPosition()
{
    return "SELECT * FROM repros ORDER BY position";
};

function createRepro()
{
    return "INSERT INTO `repros` (name, sex, available, description, main_img_path, mother_name, mother_adn, mother_champion, position) VALUES (:name, :sex, :available, :description, :main_img_path, :mother_name, :mother_adn, :mother_champion, :position)";
}

function updateRepro()
{
    return "UPDATE `repros` SET name = :name, sex = :sex, available = :available, description = :description, main_img_path = :main_img_path, mother_name = :mother_name, mother_adn = :mother_adn, mother_champion = :mother_champion WHERE id = :id";
}
function updateReproPosition()
{
    return "UPDATE `repros` SET position = :position WHERE id = :id";
}

function deleteRepro()
{
    return "DELETE FROM repros WHERE `id` = :id";
}

function getReproFromId()
{
    return "SELECT * FROM repros WHERE `id` = :id";
}
