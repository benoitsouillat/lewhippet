<?php

require_once(__DIR__ . '/../../secret/connexion.php');


function addPuppy()
{
}

function deletePuppy()
{
    return "DELETE FROM `puppies` WHERE `id` = :id";
}

function getAllPuppies()
{
    return "SELECT * FROM puppies";
};

function updatePuppy()
{
    return "UPDATE `puppies` SET name = :name, sex = :sex, available = :available, description = :description, main_img_path = :main_img_path WHERE id = :id";
}

function getPuppyFromId()
{
    return "SELECT * FROM puppies WHERE `id` = :id";
}
