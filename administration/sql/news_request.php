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
    return "INSERT INTO news (news_id, title, description, display, image) VALUES (:newsID, :title, :description, :display, :image)";
};
function updateNews()
{
    return "UPDATE news SET title = :title, description = :description, display = :display, image = :image";
};
function deleteNews()
{
    return "DELETE FROM news WHERE `news_id` = :newsID";
};
