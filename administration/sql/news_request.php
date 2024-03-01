<?php

function getAllNews()
{
    return "SELECT * FROM news";
};
function getAllNewsReverse()
{
    return "SELECT * FROM news ORDER BY `news_id` DESC";
};
function getAllNewsActives()
{
    return "SELECT * FROM news WHERE display = true";
};
function getNewsFromId()
{
    return "SELECT * FROM news WHERE :newsID = `news_id`";
}
function createNews()
{
    return "INSERT INTO news (title, description, display, image, created_at) VALUES (:title, :description, :display, :image, :createdAt)";
};
function updateNews()
{
    return "UPDATE news SET title = :title, description = :description, display = :display, image = :image WHERE news_id = :newsID";
};
function deleteNews()
{
    return "DELETE FROM news WHERE `news_id` = :newsID";
};
