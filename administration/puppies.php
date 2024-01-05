<?php
session_start();
require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/puppies_request.php');
require_once(__DIR__ . '/classes/Puppy.php');
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

            <div class="admin-menu">
                <a href="./repros.php" class="btn btn-primary m-1">Gérer les reproducteurs</a>
                <a href="./litters.php" class="btn btn-pink m-1">Gérer les portées</a>
                <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
                <a href="puppies/crud.php" class="btn btn-success m-1">Créer une vente isolée</a>
                <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>
            </div>
            <div class="query-filter-container admin-menu">
                <p class="tri-para">Options de Tri : </p>
                <a href="?query=default" class="btn btn-dark">Par default</a>
                <a href="?query=litter" class="btn btn-dark">Trier par portée</a>
                <a href="?query=litterreverse" class="btn btn-dark">Trier par dernières portées</a>
                <a href="?query=active" class="btn btn-dark">Trier par chiots actifs</a>
            </div>
            <div class="puppies-admin-container d-flex justify-content-evenly flex-wrap">
                <?php
                if (isset($_GET['query']) && $_GET['query'] !== NULL) {
                    $query = $_GET['query'];
                    switch ($query) {
                        case 'litter':
                            $stmt = $conn->query(getAllPuppiesByLitter());
                            break;
                        case 'litterreverse':
                            $stmt = $conn->query(getAllPuppiesByLastLitter());
                            break;
                        case 'active':
                            $stmt = $conn->query(getAllPuppiesByEnable());
                            break;
                        case 'default';
                            $stmt = $conn->query(getAllPuppiesByPosition());
                            break;
                        default:
                            $stmt = $conn->query(getAllPuppies());
                    }
                } else {
                    $stmt = $conn->query(getAllPuppiesByPosition());
                }
                while ($puppyData = $stmt->fetch(PDO::FETCH_OBJ)) :
                    $puppy = new Puppy();
                    $puppy->fillFromStdClass($puppyData, $conn);
                ?>
                    <div class="card justify-content-between col-10 col-sm-6 col-lg-4 col-xl-3 p-2 mt-1 
            <?php if ($puppy->getEnable() == 0) {
                        echo 'disable-filter';
                    }; ?>">
                        <div class='litter-number-info bg-info'>
                            <p class='text-center'>Portée <?php echo $puppy->getLitter()->getLitterNumberSCC() ?></p>
                        </div>
                        <div class="m1 p2 text-center bg-dark text-light">
                            <p class="w-100 col-12 text-center bg-dark text-light">Position : </p>
                            <form class="form-control bg-dark d-flex flex-row justify-content-between flex-shrink-1 col-12" action="./puppies/updater.php" method="get">
                                <input type='hidden' name='puppyId' value='<?php echo $puppy->getId() ?>'>
                                <label for="moveBefore">
                                    <button class="btn" name="moveBefore" type="submit" placeholder="Précédent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z" />
                                        </svg>
                                    </button>
                                </label>
                                <input name="positionInputer" type="number" class="col-3" value="<?php echo $puppy->getPosition() ?>">
                                <button class="btn btn-light" type="submit">Valider</button>
                                <label for="moveAfter">
                                    <button class="btn" name="moveAfter" type="submit" placeholder="Suivant">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z" />
                                        </svg>
                                    </button>
                                </label>
                            </form>
                        </div>
                        <?php echo ("
                <a href=\"./puppies/crud.php?id={$puppy->getId()}\">
                <img class='card-img-top img-admin-list' src='../{$puppy->getMainImgPath()}'
                alt='Chiot Whippet disponible'></a>
                "); ?>
                        <div class="card-body d-flex flex-column justify-content-between align-items-center">
                            <div class="d-flex flex-row justify-content-center align-items-center col-12">
                                <?php
                                if ($puppy->getSex() === "femelle") {
                                    echo "
                            <a  class=\"w-50 text-decoration-none\" href=\"./puppies/crud.php?id={$puppy->getId()}\">
                            <h3 class=\"card-title text-danger text-center\">" . ucfirst(htmlspecialchars($puppy->getName())) . "</h3></a>";
                                } else {
                                    echo "
                            <a class=\"w-50 text-decoration-none\" href=\"./puppies/crud.php?id={$puppy->getId()}\">
                            <h3 class=\"card-title text-primary text-center\">" . htmlspecialchars($puppy->getName()) . "</h3></a>";
                                }
                                if ($puppy->getAvailable() === "En option") {
                                    echo ("<p class=\"align-self-end w-50 text-center alert alert-warning\">En Option</p>");;
                                } else if ($puppy->getAvailable() === "Réservé" || $puppy->getAvailable() === 'réservé') {
                                    if ($puppy->getSex() === "femelle") {
                                        echo ("<p class=\"w-50 text-center alert alert-danger\">Réservée</p>");
                                    } else {
                                        echo ("<p class=\"w-50 text-center alert alert-danger\">Réservé</p>");
                                    }
                                } else {
                                    echo ("<p class=\"w-50 text-center alert alert-success\">Disponible</p>");
                                }
                                ?>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($puppy->getDescription()); ?></p>
                            <?php
                            echo "<p class='d-flex flex-row justify-content-evenly align-items-center flex-wrap m-2'>
                            <span class='alert alert-mother m-2 mt-0 p-2'>Maman : {$puppy->getLitter()->getMother()->getName()}</span>";
                            if ($puppy->getLitter()->getMother()->getIsChampion()) {
                                echo '<span class="alert alert-secondary m-2 mt-0 p-2">Championne</span>';
                            }
                            if ($puppy->getLitter()->getMother()->getIsAdn()) {
                                echo "<span class='alert alert-info m-2 mt-0 p-2'>ADN</span></p>";
                            }
                            echo "<p class='d-flex flex-row justify-content-evenly align-items-center flex-wrap m-2'>
                            <span class='alert alert-primary m-2 mt-0 p-2'>Papa : {$puppy->getLitter()->getFather()->getName()}</span>";
                            if ($puppy->getLitter()->getFather()->getIsChampion()) {
                                echo '<span class="alert alert-secondary m-2 mt-0 p-2">Champion</span>';
                            }
                            if ($puppy->getLitter()->getFather()->getIsAdn()) {
                                echo "<span class='alert alert-info m-2 mt-0 p-2'>ADN</span></p>";
                            }
                            ?>
                            <div class="btn-container">
                                <a href="./puppies/crud.php?id=<?php echo $puppy->getId() ?>" class="btn btn-primary">Modifier</a>
                                <button onClick="confirmDeletePuppy(<?php echo $puppy->getId() ?>,  '<?php echo replace_reunion_char($puppy->getName()) ?>')" class="btn btn-danger">Supprimer</button>
                                <?php
                                echo $puppy->getEnable() ?
                                    "<button onClick='toggleActivePuppy({$puppy->getId()}, {$puppy->getEnable()})' class='btn btn-warning toggler'
                                    id='toggler{$puppy->getId()} '>Désactiver
                                    </button>"
                                    :
                                    "<button onClick='toggleActivePuppy({$puppy->getId()}, {$puppy->getEnable()})' class='btn btn-success toggler'
                                    id='toggler{$puppy->getId()}'>Activer
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