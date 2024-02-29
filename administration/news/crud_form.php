<?php
session_start();
require_once('../classes/News.php');
require_once('../sql/news_request.php');
require_once('../utilities/usefull_functions.php');
require_once(__DIR__ . '/../../database/requestPDO.php');
require_once(__DIR__ . '/../../php/resizer.php');
?>
<form action="../news.php" method="post">
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" class="form-control"><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description" class="form-control"></textarea><br>

    <label for="display">Affichage :</label><br>
    <select id="display" name="display" class="form-control">
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select><br>

    <label for="image">Image :</label><br>
    <input type="file" id="image" name="image" class="form-control"><br>

    <input type="submit" value="Envoyer" class="btn btn-success">
</form>