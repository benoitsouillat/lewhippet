<?php


function getAvailableColor($value)
{
    if ($value === 'En option')
        return "warning";
    elseif ($value === 'Réservé')
        return "danger";
    elseif ($value === 'Disponible')
        return "success";
    else {
        return 'error';
    }
}
function getSexColor($value)
{
    if ($value === 'male' || $value === 'Male' || $value === 'Mâle')
        return "blue";
    elseif ($value === 'female' || $value === 'femelle' || $value === 'Femelle')
        return "pink";
    else {
        return "error";
    }
}
