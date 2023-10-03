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
    return "INSERT INTO `litters` (
        birthdate, 
        mother_id, 
        father_id, 
        number_of_puppies, 
        number_of_males, 
        number_of_females, 
        litter_number) 
        VALUES (
        :birthdate, 
        :mother_id, 
        :father_id, 
        :numberPuppies, 
        :numberMales, 
        :numberFemales, 
        :litterNumberSCC)";
}

function updateLitter()
{
    return "UPDATE `litters` SET birthdate = :birthdate, mother_id = :mother_id, father_id = :father_id, number_of_puppies = :numberPuppies, number_of_males = :numberMales, number_of_females = :numberFemales, litterNumberSCC = :litterNumberSCC WHERE id = :id";
}

function deleteLitter()
{
    return "DELETE FROM `litters` WHERE `id` = :id";
}