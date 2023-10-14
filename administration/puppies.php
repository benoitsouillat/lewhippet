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
        <div class="puppies-admin-container d-flex justify-content-evenly flex-wrap">
            <?php
                $stmt = $conn->query(getAllPuppiesByPosition());
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                ?>
            <div class="card justify-content-between col-10 col-sm-6 col-lg-4 col-xl-3 p-2 mt-1 <?php if ($row['enable'] == 0) {
                                                                                                            echo 'disable-filter';
                                                                                                        } ?>">
                <div class="m1 p2 text-center bg-dark text-light">
                    <p class="w-100 col-12 text-center bg-dark text-light">Position : </p>
                    <form class="form-control bg-dark d-flex flex-row justify-content-between flex-shrink-1 col-12"
                        action="./puppies/updater.php" method="get">
                        <input type='hidden' name='puppyId' value='<?php echo $row['id'] ?>'>
                        <label for="moveBefore">
                            <button class="btn" name="moveBefore" type="submit" placeholder="Précédent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z" />
                                </svg>
                            </button>
                        </label>
                        <input name="positionInputer" type="number" class="col-3"
                            value="<?php echo $row['position'] ?>">
                        <button class="btn btn-light" type="submit">Valider</button>
                        <label for="moveAfter">
                            <button class="btn" name="moveAfter" type="submit" placeholder="Suivant">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z" />
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
                <div class="card-body d-flex flex-column justify-content-between align-items-center">
                    <div class="d-flex flex-row justify-content-center align-items-center col-12">
                        <?php
                                if ($row['sex'] === "femelle") {
                                    echo "
                            <a  class=\"w-50 text-decoration-none\" href=\"./puppies/crud.php?id={$row['id']}\">
                            <h3 class=\"card-title text-danger text-center\">" . ucfirst(htmlspecialchars($row['name'])) . "</h3></a>";
                                } else {
                                    echo "
                            <a class=\"w-50 text-decoration-none\" href=\"./puppies/crud.php?id={$row['id']}\">
                            <h3 class=\"card-title text-primary text-center\">" . htmlspecialchars($row['name']) . "</h3></a>";
                                }
                                if ($row['available'] === "En option") {
                                    echo ("<p class=\"align-self-end w-50 text-center alert alert-warning\">En Option</p>");;
                                } else if ($row['available'] === "Réservé" || $row['available'] === 'réservé') {
                                    if ($row['sex'] === "femelle") {
                                        echo ("<p class=\"w-50 text-center alert alert-danger\">Réservée</p>");
                                    } else {
                                        echo ("<p class=\"w-50 text-center alert alert-danger\">Réservé</p>");
                                    }
                                } else {
                                    echo ("<p class=\"w-50 text-center alert alert-success\">Disponible</p>");
                                }
                                ?>
                    </div>
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php
                            echo "<p class='d-flex flex-row justify-content-evenly align-items-center flex-wrap m-2'>
                            <span class='alert alert-primary m-2 mt-0 p-2'>Maman : {$row['mother_name']}</span>";
                            if ($row['mother_champion']) {
                                echo '<span class="alert alert-secondary m-2 mt-0 p-2">Championne</span>';
                            }
                            if ($row['mother_adn']) {
                                echo "<span class='alert alert-info m-2 mt-0 p-2'>ADN</span></p>";
                            }
                            ?>
                    <div class="btn-container w-100 d-flex flex-row justify-content-between">
                        <a href="./puppies/crud.php?id=<?php echo $row['id'] ?>"
                            class="btn btn-primary m-1 p-3">Modifier</a>
                        <button
                            onClick="confirmDeletePuppy(<?php echo $row['id'] ?>,  '<?php echo replace_reunion_char($row['name']) ?>')"
                            class="btn btn-danger m-1">Supprimer</button>
                        <?php
                                echo $row['enable'] ?
                                    "<button onClick='toggleActivePuppy({$row['id']}, {$row['enable']})' class='m-1 p-3 btn btn-warning toggler'
                                    id='toggler{$row['id']} '>Désactiver
                                    </button>"
                                    :
                                    "<button onClick='toggleActivePuppy({$row['id']}, {$row['enable']})' class=' m-1 p-3 btn btn-success toggler'
                                    id='toggler{$row['id']} '>Activer
                                    </button>"
                                ?>
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