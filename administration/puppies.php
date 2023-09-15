<?php
session_start();
require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/puppies_request.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les chiots</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <main class="d-flex flex-column justify-content-center">
        <?php
        if (isset($_SESSION['username'])) {
        ?>

        <h1 class="text-center alert alert-info p-4 m-0">Retrouvez tous les chiots sur cette page</h1>
        <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
            <?php echo $_SESSION['username'] ?></p>

        <div class="d-flex flex-row justify-content-center m-2 p-2">
            <a href="puppies/crud.php" class="btn btn-success m-1">Créer un nouveau chiot</a>
            <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
            <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>

        </div>
        <div class="puppies-admin-container d-flex justify-content-around flex-wrap">
            <?php
                $stmt = $conn->query(getAllPuppies());
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                ?>
            <div class="card col-6 col-sm-4 col-lg-3 p-2 mt-1">
                <?php echo ("
                <a href=\"./puppies/crud.php?id={$row['id']}\">
                <img class='card-img-top img-admin-list' src='../{$row['main_img_path']}'
                alt='Chiot Whippet disponible'></a>
                "); ?>
                <div class="card-body">
                    <?php
                            if ($row['sex'] === "femelle") {
                                echo "
                            <a  class=\"text-decoration-none\" href=\"./puppies/crud.php?id={$row['id']}\">
                            <h3 class=\"card-title text-danger text-center\">" . ucfirst(htmlspecialchars($row['name'])) . "</h3></a>";
                            } else {
                                echo "
                            <a class=\"text-decoration-none\" href=\"./puppies/crud.php?id={$row['id']}\">
                            <h3 class=\"card-title text-primary text-center\">" . htmlspecialchars($row['name']) . "</h3></a>";
                            }
                            ?> <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php
                            if ($row['available'] === "En option") {
                                echo ("<p class=\"alert alert-warning\">En Option</p>");;
                            } else if ($row['available'] === "Réservé" || $row['available'] === 'réservé') {
                                if ($row['sex'] === "femelle") {
                                    echo ("<p class=\"alert alert-danger\">Réservée</p>");
                                } else {
                                    echo ("<p class=\"alert alert-danger\">Réservé</p>");
                                }
                            } else {
                                echo ("<p class=\"alert alert-success\">Disponible</p>");;
                            }
                            ?>
                    <div class="btn-container d-flex flex-row justify-content-around flex-wrap">
                        <a href="./puppies/crud.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Modifier</a>
                        <a href="./puppies/crud.php?id=<?php echo $row['id'] ?>&delete=true"
                            class="btn btn-danger">Supprimer</a>
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