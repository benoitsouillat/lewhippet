<?php
session_start();
require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/repros_request.php');
require_once(__DIR__ . '/sql/litters_request.php');
require_once(__DIR__ . '/classes/Litter.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des reproducteurs</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Favicon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src='../script/admin.js' type='text/javascript' defer></script>
    <!-- fontAwesome Icon -->
    <script src="https://kit.fontawesome.com/5944b63bf2.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <main class="d-flex flex-column justify-content-center">
        <?php
        if (isset($_SESSION['username'])) {
        ?>

        <h1 class="text-center alert alert-info p-4 m-0">Retrouvez toutes les portées sur cette page</h1>
        <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
            <?php echo $_SESSION['username'] ?></p>

        <div class="d-flex flex-row justify-content-center m-2 p-2">
            <a href="./repros.php" class="btn btn-primary m-1">Gérer les reproducteurs</a>
            <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
            <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>

        </div>
        <div class="puppies-admin-container d-flex justify-content-around flex-wrap">
            <?php
                $stmt = $conn->query(getAllLitters());
                while ($litterData = $stmt->fetch(PDO::FETCH_OBJ)) :
                    $litter = new Litter();
                    $litter->fillFromStdClass($litterData);
                    var_dump($litter);
                    die();
                ?>
            <div class="card col-6 co   l-sm-4 col-lg-3 p-2 mt-1">
                <p>Portée de </p>
                <?php echo ("
                <a href=\"./puppies/crud.php?id={$litterData->id}\">
                <img class='card-img-top img-admin-list' src='../{$litter->getMother()->getMainImgPath()}'
                alt='Chiot Whippet disponible'></a>
                "); ?>
                <div class="card-body">

                    <div class="btn-container d-flex flex-row justify-content-around flex-wrap">
                        <a href="./litters/crud.php?repro_id=<?php echo $litterData->id ?>"
                            class="btn btn-success m-2 p-3">Modifier</a>
                        <button
                            onClick="confirmDeleteLitter(<?php echo $litterData->id ?>,  '<?php echo replace_reunion_char($row['name']) ?>')"
                            class="btn btn-outline-danger m-2">Supprimer</button>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
                ?>
        </div>
        <?php
        } else {
            echo "<div class='text-center alert alert-danger'><p>Vous n'êtes pas connecté !!! </p><br><a class='btn btn-success' href='./login.php'>Se connecter</a></div>";
        }
        ?>
    </main>
</body>

</html>