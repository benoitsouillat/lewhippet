<?php
session_start();
require_once('../classes/News.php');
require_once('../sql/news_request.php');

$news = new News();
if (isset($_POST) && $_POST !== null && !empty($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['news_id'] <= 0) {
        $news->fillFromForm($_POST);
        if (isset($_FILES['news_image']) && $_FILES['news_image']['name'] != null) {
            $news->moveNewsImage($_FILES);
        }
        $news->createNews();
    } elseif ($_POST['news_id'] > 0) {
        $news->fillFromForm($_POST);
        $news->setId($_POST['news_id']);
        if (isset($_FILES['news_image']) && $_FILES['news_image']['name'] != null) {
            $news->moveNewsImage($_FILES);
        }
        $news->updateNews();
    }
    header('Location:../news.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['delete'] === 'true' && isset($_GET['id'])) {
        $news->fillFromDatabase($_GET['id']);
        try {
            $news->deleteNews();
            header('Location:../news.php');
        } catch (PDOException $e) {
            echo "Erreur lors de la redirection suite à la suppression !";
        }
    }
}
