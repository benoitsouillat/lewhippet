<?php

require_once(__DIR__ . '/../../secret/connexion.php');


function addPuppy()
{
}

function deletePuppy($id)
{
    return "DELETE FROM `puppies` WHERE `id` = :id";
}

function getAllPuppies()
{
    return "SELECT * FROM puppies";
};

function getPuppyFromId($id)
{
    return "SELECT * FROM puppies where `id` = :id";
}