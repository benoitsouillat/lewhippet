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
                <a href="./news/crud_form.php" class="btn btn-info m-1">Créer une Actu</a>
                <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
                <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>
            </div>
            <div class="query-filter-container admin-menu">
                <a href="?query=active" class="btn btn-dark">Actus Actives</a>
                <a href="?query=last" class="btn btn-dark">Dernières Actus</a>
            </div>
            <div class="puppies-admin-container d-flex justify-content-evenly flex-wrap">
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

                        echo $news->getTitle();
                    }


                ?>

                    <div class="container d-flex flex-column nowrap">
                        <div class="d-flex flex-row justify-content-between align-items-center nowrap m-2">
                            <a href="#">
                                <p class="row-title">Mon super Titre</p>
                            </a>
                            <p>Ma Description</p>
                            <img class="w-25" src="../2chiot-bras.jpg" alt="Mon super titre">
                            <span class="badge bg-success p-2">En Ligne</span>
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center nowrap m-2">
                            <a href="#">
                                <p class="row-title">Mon super Titre</p>
                            </a>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatibus, nisi suscipit
                                numquam dicta earum necessitatibus molestias voluptatem vero quaerat nulla saepe delectus
                                doloremque blanditiis eius velit doloribus sit ullam ducimus accusamus dignissimos similique at
                                distinctio. Eius aperiam sint, deserunt alias, quia exercitationem necessitatibus aliquid ipsa
                                asperiores in dolor. Sit est iure asperiores consectetur beatae, voluptas aut similique.</p>
                            <img class="w-25" src="../2chiot-bras.jpg" alt="Mon super titre">
                            <span class="badge bg-danger p-2">Hors Ligne</span>
                        </div>
                    </div>

                <?php
                endwhile;
                ?>
            <?php
        };
            ?>
    </main>

</body>

</html>