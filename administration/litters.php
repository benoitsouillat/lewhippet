<?php
session_start();
// require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/repros_request.php');
require_once(__DIR__ . '/sql/litters_request.php');
require_once(__DIR__ . '/classes/Litter.php');
require_once(__DIR__ . '/../database/requestPDO.php');
$pdo = new RequestPDO();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des portées</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Favicon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src='../script/admin.js' type='text/javascript'></script>
    <!-- fontAwesome Icon -->
    <script src="https://kit.fontawesome.com/5944b63bf2.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <main class="d-flex flex-column justify-content-center">
        <?php
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['error'])) {
                $errorArray = [];
                $sessionErrors = $_SESSION['error'];

                echo "<div id='errorContainer' class='error-container'>";
                echo "<script type='text/javascript'>";
                echo "var errorArray = " . json_encode($sessionErrors) . ";";
                echo "</script>";
                echo "<script>errorLitterDisplay();</script>";
                echo "</div>";
                $_SESSION['error'] = [];
            }
        ?>
            <h1 class="text-center alert alert-info p-4 m-0">Retrouvez toutes les portées sur cette page</h1>
            <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
                <?php echo $_SESSION['username'] ?></p>

            <div class="admin-menu">
                <a href="./repros.php" class="btn btn-primary m-1">Voir les reproducteurs</a>
                <a href="./puppies.php" class="btn btn-success m-1">Gérer les chiots</a>
                <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
                <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>

            </div>
            <div class="puppies-admin-container d-flex justify-content-around flex-wrap">
                <?php
                $stmt = $pdo->connect()->prepare(getAllLitters());
                $stmt->execute();
                while ($litterData = $stmt->fetch(PDO::FETCH_OBJ)) :
                    $litter = new Litter();
                    $litter->fillFromStdClass($litterData);
                    $litter->setLitterNumberSCC($litterData->litter_number)
                ?>
                    <div class="card col-6 col-sm-4 col-lg-3 p-2 mt-1  <?php if ($litter->getEnable() == false) {
                                                                            echo "disable-filter";
                                                                        } ?>">
                        <h4 class="text-center">Portée de <br>
                            <?php echo $litter->getMother()->getName() . ' et de ' . $litter->getFather()->getName() ?>
                        </h4>
                        <?php
                        echo ("
                <a href=\"./litters/crud.php?id={$litterData->id}&repro_id={$litter->getMother()->getId()}\">
                <img 
                class='card-img-top img-admin-list' 
                src='{$litter->getMother()->getMainImgPath()}'
                alt='Chiot Whippet disponible'>
                </a>"); ?>
                        <div class="card-body">
                            <p class="text-center">
                                <?php echo 'Portée N° : ' . $litter->getLitterNumberSCC() ?>
                            </p>
                            <p class="text-center">
                                <?php echo 'Né(s) le ' . trad_month(date('d F Y', strtotime($litter->getBirthdate()))) . '<br>' . $litter->getNumberMales() . ' mâle(s) et ' . $litter->getNumberFemales() . ' femelle(s).' ?>
                            </p>

                            <div class="btn-container d-flex flex-row justify-content-around flex-wrap">
                                <a href="./litters/crud.php?id=<?php echo $litterData->id ?>&repro_id=<?php echo $litter->getMother()->getId() ?>" class="btn btn-primary m-2 p-3">Modifier</a>
                                <?php
                                echo $litter->getEnable() ?
                                    "<button onClick='toggleActiveLitter({$litter->getId()}, {$litter->getEnable()})'  class='m-1 p-3 btn btn-warning toggler'>Désactiver</button>"
                                    :
                                    "<button onClick='toggleActiveLitter({$litter->getId()}, {$litter->getEnable()})' class='m-1 p-3 btn btn-success toggler'>Activer</button>"
                                ?>
                                <button onClick="confirmDeleteLitter(<?php echo $litterData->id ?>,  '<?php echo replace_reunion_char($litter->getMother()->getName()) ?>')" class="btn btn-outline-danger m-2">Supprimer</button>
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