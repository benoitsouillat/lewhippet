<?php

function getAllPuppies()
{
    return "SELECT * FROM puppies";
};

function getAllPuppiesByPosition()
{
    return "SELECT * FROM puppies ORDER BY position, Litter ASC";
};
function getAllPuppiesByEnable()
{
    return "SELECT puppies.* FROM puppies JOIN litters ON puppies.Litter = litters.id WHERE litters.enable = TRUE ORDER BY puppies.enable DESC";
}
function getAllPuppiesByLitter()
{
    return "SELECT * FROM puppies ORDER BY Litter ASC, position ASC";
}
function getAllPuppiesByLastLitter()
{
    return "SELECT * FROM puppies ORDER BY Litter DESC, position ASC";
}
function getAllPuppiesByPositionAndLitter()
{
    return "SELECT * FROM puppies WHERE Litter = :litter_id ORDER BY position";
};

function createPuppy()
{
    return "INSERT INTO `puppies` (name, sex, color, description, available, enable, Litter, main_img_path, position) 
    VALUES (:name, :sex, :color, :description, :available, :enable, :litter_id, :main_img_path, :position)";
}

function updatePuppy()
{
    return "UPDATE `puppies` SET name = :name, sex = :sex, color = :color, available = :available, description = :description, main_img_path = :main_img_path WHERE id = :id";
}
function updatePuppyPosition()
{
    return "UPDATE `puppies` SET position = :position WHERE id = :id";
}

function deletePuppy()
{
    return "DELETE FROM `puppies` WHERE `id` = :id";
}

function getPuppyFromId()
{
    return "SELECT * FROM puppies WHERE `id` = :id";
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
function deletePuppyImage()
{
    return "DELETE FROM `images` WHERE `id` = :imageId";
}

function togglePuppy()
{
    return "UPDATE `puppies` SET `enable` = :enable WHERE id = :id";
}
