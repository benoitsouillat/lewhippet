<?php
session_start();
require_once('../classes/News.php');
require_once('../sql/news_request.php');

$news = new News();
if (isset($_POST) && $_POST !== null && !empty($_POST)) {
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
