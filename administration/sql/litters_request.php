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
    return "UPDATE `litters` SET name = :name, sex = :sex, color = :color, `insert` = :insert, description = :description, main_img_path = :main_img_path, breeder = :breeder, birth_date = :birthdate, lofselect_link = :lofselect, is_adn = :adn, is_champion = :champion WHERE id = :id";
}

function deleteLitter()
{
    return "DELETE FROM `litters` WHERE `id` = :id";
}
