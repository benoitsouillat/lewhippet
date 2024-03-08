<?php

function getAllLitters()
{
    return "SELECT * FROM `litters` ORDER BY position ASC";
}
function getAllLittersIds()
{
    return "SELECT id FROM `litters`";
}
function getAllLittersActive()
{
    return "SELECT * FROM `litters` WHERE `enable` = true ORDER BY position ASC";
}
function getLitterFromId()
{
    return "SELECT * FROM litters WHERE `id` = :id";
}
function createLitter()
{
    return "INSERT INTO `litters` (
        birthdate, 
        mother_id, 
        father_id, 
        number_of_puppies, 
        number_of_males, 
        number_of_females, 
        litter_number,
        position) 
        VALUES (
        :birthdate, 
        :mother_id, 
        :father_id, 
        :numberPuppies, 
        :numberMales, 
        :numberFemales, 
        :litterNumberSCC,
        :position)";
}

function updateLitter()
{
    return "UPDATE `litters` SET birthdate = :birthdate, mother_id = :mother_id, father_id = :father_id, number_of_puppies = :numberPuppies, number_of_males = :numberMales, number_of_females = :numberFemales, litter_Number = :litterNumberSCC, position = :position WHERE id = :id";
}
function updateLitterPosition()
{
    return "UPDATE `litters` SET position = :position WHERE id = :litterID";
}
function toggleLitter()
{
    return "UPDATE `litters` SET `enable` = :enable WHERE id = :id";
}
function deleteLitter()
{
    return "DELETE FROM `litters` WHERE `id` = :id";
}
