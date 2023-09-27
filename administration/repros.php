<?php
session_start();
require_once(__DIR__ . '/../secret/connexion.php');
require_once(__DIR__ . '/utilities/usefull_functions.php');
require_once(__DIR__ . '/sql/repros_request.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des reproducteurs</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                <a href="repros/crud.php" class="btn btn-info m-1">Créer un nouveau reproducteurs</a>
                <a href="./gerance.php" class="btn btn-dark m-1">Retour à la gestion</a>
                <a href="logout.php" class="btn btn-danger m-1">Se déconnecter</a>
            </div>
            <div class="puppies-admin-container d-flex justify-content-around flex-wrap">
                <?php
                $stmt = $conn->query(getAllRepros());
                while ($repro = $stmt->fetch(PDO::FETCH_OBJ)) :
                ?>
                    <div class="card col-12 d-flex flex-row justify-content-center align-items-start flex-wrap flex-grow-1">
                        <div class="repro_text col-6">
                            <h6 class="col-12 text-center">
                                <?php
                                if ($repro->sex == 'Femelle' || $repro->sex == 'femelle' || $repro->sex == 'female') {
                                    echo " <i class='bi bi-gender-female'> </i> " . $repro->name . ' ' .  $repro->breeder;
                                } else {
                                    echo " <i class='bi bi-gender-male'> </i> " . $repro->name . ' ' .  $repro->breeder;
                                }
                                ?>
                            </h6>
                            <p>Numéro de puce : <?php echo $repro->insert ?></p>
                            <p>Couleur : <?php echo $repro->color ?></p>
                            <p class="text-center"><?php echo $repro->description ?></p>
                            <p>Né le : <?php echo $repro->birth_date ?></p>
                            <div class="d-flex flex-row justify-content-around align-items-center col-11 text-center">
                                <?php
                                if ($repro->is_adn == true) {
                                    echo "<p class='alert alert-info'>ADN Vérifié</p>";
                                }
                                if ($repro->is_champion == true) {
                                    echo "<p class='alert alert-primary'>Champion</p>";
                                }
                                ?>

                            </div>


                            <div class="d-flex flex-row justify-content-evenly col-12">
                                <a href="./repros/crud.php?id=<?php echo $repro->id ?>" class="btn btn-primary m-2 p-3">Modifier</a>
                                <button onClick="confirmDeleteRepro(<?php echo $repro->id ?>,  '<?php echo replace_reunion_char($repro->name); ?>')" class="btn btn-danger m-2">Supprimer</button>
                            </div>
                        </div>
                        <img class="col-4 p-2 m-2 border border-2 border-dark rounded" src="../repros_img/<?php echo $repro->main_img_path ?> " alt="Lévrier Whippet">


                    </div>
                <?php
                endwhile;
                ?>

            <?php
        }
            ?>
</body>

</html>