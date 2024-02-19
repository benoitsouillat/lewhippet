<?php

function addUser()
{
    return "INSERT INTO users (email, password, img_profile_path) VALUES (:email, :password, :img_profile_path) ";
}

function getAllUsers()
{
    return "SELECT email FROM users";
}

function getUser($email)
{
    return "SELECT * FROM users WHERE email=$email";
}

function setUserRole()
{
    return "UPDATE users SET role = :role WHERE `id` = :id";
}
