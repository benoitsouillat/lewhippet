<?php
session_start();
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/../database/requestPDO.php');
require_once(__DIR__ . '/sql/news_request.php');
require_once(__DIR__ . '/classes/News.php');
$pdo = new RequestPDO();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les chiots</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src='../script/admin.js' type='text/javascript'></script>
</head>

<body>
    <main class="d-flex flex-column justify-content-center">
        <?php
        if (isset($_SESSION['username'])) {
        ?>

            <h1 class="text-center alert alert-info p-4 m-0">Retrouvez toutes les actualités</h1>
            <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
                <?php echo $_SESSION['username'] ?></p>

            <div class="admin-menu">
                <a href="./repros.php" class="btn btn-primary m-1">Gérer les reproducteurs</a>
                <a href="./litters.php" class="btn btn-pink m-1">Gérer les portées</a>
                <a href="./puppies.php" class="btn btn-success m-1">Gérer les chiots</a>
                <a href="./templates/news_form.php" class="btn btn-info m-1">Créer une Actu</a>
                <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
                <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>
            </div>
            <div class="query-filter-container admin-menu">
                <a href="?query=active" class="btn btn-dark">Actus Actives</a>
                <a href="?query=last" class="btn btn-dark">Dernières Actus</a>
            </div>
            <div class="puppies-admin-container d-flex justify-content-evenly flex-wrap">
                <div class="news_list_container">

                    <?php
                    if (isset($_GET['query']) && $_GET['query'] !== NULL) {
                        $query = $_GET['query'];
                        switch ($query) {
                            case 'active':
                                $stmt = $pdo->connect()->query(getAllNewsActives());
                                break;
                            case 'last':
                                $stmt = $pdo->connect()->query(getAllNewsReverse());
                                break;
                            default:
                                $stmt = $pdo->connect()->query(getAllNews());
                        }
                    } else {
                        $stmt = $pdo->connect()->query(getAllNews());
                    }
                    while ($newsData = $stmt->fetch(PDO::FETCH_OBJ)) : {
                            $news = new News();
                            $news->fillFromStdClass($newsData);

                            echo "
                        <div class='news_list_content'>
                        <div class='text'>
                            <a href='./templates/news_form.php?newsID={$news->getId()}'>
                                <p class='row_title'>{$news->getTitle()}</p>
                            </a>
                            <p class='row_description'>{$news->getDescription()}</p>
                            <p class='row_create_date'> - Créé le : {$news->getCreatedAt()}</p>
                        </div>
                        <img class='w-25' src='{$news->getImage()}' alt='{$news->getTitle()}'>
                        <div class='button_container'>";

                            if ($news->getDisplay() === 1 || $news->getDisplay() === true) {
                                echo "<span class='badge bg-success'>En Ligne</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Hors Ligne</span>";
                            }
                            echo "
                            <a class='btn btn-sm btn-primary' href='./templates/news_form.php?newsID={$news->getId()}'>Modifier</a>
                            <button onClick='confirmDeleteNews({$news->getId()})' class='btn btn-sm btn-outline-danger'>Supprimer
                            </button>
                        </div>
                    </div>";
                        }
                    ?>
                    <?php
                    endwhile;
                    ?>
                </div>
            <?php
        }; #Fermeture de la condition Session
            ?>
    </main>

</body>

</html>