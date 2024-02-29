<?php

require_once(__DIR__ . '/../classes/News.php');
require_once(__DIR__ . '/../sql/news_request.php');
$news = new News();
if (isset($_GET['newsID']) && $_GET['newsID'] > 0) {
    $news->fillFromDatabase($_GET['newsID']);
}

?>

<form action="../news/crud_news.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="news_id" value="<?php echo $news->getId() ?>">

    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" class="form-control" value="<?php echo $news->getTitle() ?>"><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description" class="form-control"><?php echo $news->getDescription() ?></textarea><br>

    <label for="display">Affichage :</label><br>
    <select id="display" name="display">
        <option value="1" <?php if ($news->getDisplay()) echo "selected"; ?>>Oui</option>
        <option value="0" <?php if (!$news->getDisplay()) echo "selected"; ?>>Non</option>
    </select><br>

    <label for="news_image">Image :</label><br>
    <?php if (!empty($news->getImage())) : ?>
        <img src="<?php echo $news->getImage(); ?>" alt="<?php echo $news->getTitle() ?>"><br>
    <?php endif; ?>
    <input type="file" id="news_image" name="news_image" class="form-control" value="<?php echo $news->getImage() ?>"><br>

    <input type="submit" value="Envoyer" class="btn btn-success">
</form>