<?php
session_start();
require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/repros_request.php');
require_once(__DIR__ . '/classes/Repro.php');
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
        <h1 class="text-center alert alert-info p-4 m-0">Retrouvez les reproducteurs sur cette page</h1>
        <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
            <?php echo $_SESSION['username'] ?></p>


        <div class="d-flex flex-row justify-content-center m-2 p-2">
            <a href="repros/crud.php" class="btn btn-primary m-1">Créer un nouveau reproducteurs</a>
            <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
            <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>
        </div>
        <div class="repros-admin-container d-flex justify-content-around flex-wrap">
            <?php
                $stmt = $conn->query(getAllRepros());
                while ($reproData = $stmt->fetch(PDO::FETCH_OBJ)) :
                    $repro = new Repro();
                    $repro->fillFromStdClass($reproData);
                ?>
            <div <?php echo $repro->getSex() == "femelle" ?
                                'class="card col-7 col-md-5 bg-pink"' :
                                'class="card col-7 col-md-5 bg-blue"'; ?>>
                <h6 class="col-12 text-center">
                    <?php
                            if ($repro->getSex() == 'Femelle' || $repro->getSex() == 'femelle' || $repro->getSex() == 'female') {
                                echo " <i class='bi bi-gender-female'> </i> " . $repro->getName() . ' ' .  $repro->getBreeder();
                            } else {
                                echo " <i class='bi bi-gender-male'> </i> " . $repro->getName() . ' ' .  $repro->getBreeder();
                            }
                            ?>
                </h6>
                <div class="repro_text col-6 col-sm-8 d-flex flex-column justify-content-center align-items-center">
                    <p>Numéro de puce : <?php echo $repro->getInsert() ?></p>
                    <p>Couleur : <?php echo $repro->getColor() ?></p>
                    <p><?php echo $repro->getDescription() ?></p>
                    <p>Né le : <?php echo $repro->getBirthdate() ?></p>

                    <div class="d-flex flex-column flex-sm-row justify-content-evenly col-12 col-md-8">
                        <a href='<?php echo $repro->getLofselect() ?>'
                            class="btn btn-outline-primary m-2 p-2 text-nowrap" target="_blank">Lof
                            Select</a>
                        <a href="./repros/crud.php?id=<?php echo $reproData->id ?>"
                            class="btn btn-success m-2 p-2">Modifier</a>
                        <button
                            onClick="confirmDeleteRepro(<?php echo $reproData->id ?>,  '<?php echo replace_reunion_char($repro->getName()); ?>')"
                            class="btn btn-outline-danger m-2">Supprimer</button>
                    </div>
                </div>
                <div class="col-6 col-sm-4">
                    <div class="d-flex flex-row justify-content-around align-items-center col-11 text-center">
                        <?php
                                if ($repro->getIsAdn() == true) {
                                    echo "<p class='alert alert-warning p-2'>ADN Vérifié</p>";
                                }
                                if ($repro->getIsChampion() == true) {
                                    echo "<p class='alert alert-success p-2'>Champion</p>";
                                }
                                ?>
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center">
                        <a href="./repros/crud.php?id=<?php echo $reproData->id ?>"
                            class="d-flex justify-content-center"><img
                                class="p-2 m-2 border border-2 border-dark rounded"
                                src="../repros_img/<?php echo $reproData->main_img_path ?> " alt="Lévrier Whippet"></a>
                        <?php if ($repro->getSex() == 'femelle') {
                                    echo '<a href="./litters/crud.php?repro_id=' . $reproData->id . '" class="btn btn-pink">Nouvelle Portée</a>';
                                } ?>
                    </div>
                </div>


            </div>
            <?php
                endwhile;
                ?>

            <?php
        }
            ?>
</body>

</html>