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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src='../script/admin.js' type='text/javascript'></script>

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
                        <div class="m1 p2">
                            <form class="form-control d-flex flex-row justify-content-between flex-wrap" action="./puppies/updater.php" method="get">
                                <input type='hidden' name='puppyId' value='<?php echo $row['id'] ?>'>
                                <label for="moveBefore">
                                    <button class="btn" name="moveBefore" type="submit" placeholder="Précédent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z" />
                                        </svg>
                                    </button>
                                </label>
                                <label class="w-100 col-11" for="positionInputer">Position :</label>
                                <input name="positionInputer" class="col-3" type="number" value="<?php echo $row['position'] ?>">
                                <button type="submit">Valider</button>
                                <label for="moveAfter">
                                    <button class="btn" name="moveAfter" type="submit" placeholder="Suivant">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z" />
                                        </svg>
                                    </button>
                                </label>
                            </form>
                        </div>
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
                            ?> <p class="card-text">
                                <?php echo htmlspecialchars($row['description']); ?></p>
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
                            echo "<p class='d-flex flex-row justify-content-end flex-wrap m-2'>Maman : {$row['mother_name']}";
                            if ($row['mother_adn']) {
                                echo "<span class='alert alert-info m-2 mt-0 p-1'>ADN</span>";
                            }
                            if ($row['mother_champion']) {
                                echo '<span class="alert alert-secondary m-2 mt-0 p-1">Championne</span></p>';
                            }
                            ?>
                            <div class="btn-container d-flex flex-row justify-content-around flex-wrap">
                                <a href="./puppies/crud.php?id=<?php echo $row['id'] ?>" class="btn btn-primary m-2 p-3">Modifier</a>
                                <button onClick="confirmDeletePuppy(<?php echo $row['id'] ?>,  '<?php echo replace_reunion_char($row['name']) ?>')" class="btn btn-danger m-2">Supprimer</button>
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