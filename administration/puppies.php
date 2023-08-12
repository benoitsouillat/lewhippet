<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les chiots</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <main>

        <?php
        // Désactivé pour le développement if (isset($_SESSION['username'])) {
        ?>

        <h1 class="text-center alert alert-info p-5">Retrouvez tous les chiots sur cette page</h1>

        <div>
            <a href="#" class="btn btn-success">Créer un nouveau chiot</a>
        </div>
        <div class="puppies_container d-flex justify-content-around">

            <div class="card w-25">
                <img class="card-img-top" src="../puppies_img/photo.jpg" alt="Chiot Whippet disponible">
                <div class="card-body">
                    <h3 class="card-title">Josette</h3>
                    <p class="card-text">Jolie femelle disponible, né le 31 Juillet 2023, fille de Samourai et
                        Philosophe, disponible à partir du 30 Octobre 2023.</p>
                    <p class="alert alert-warning">En Option</p>
                </div>
            </div>
            <div class="card w-25">
                <img class="card-img-top" src="../puppies_img/photo.jpg" alt="Chiot Whippet disponible">
                <div class="card-body">
                    <h3 class="card-title">Poupy</h3>
                    <p class="card-text">Jolie femelle disponible, né le 31 Juillet 2023, fille de Samourai et
                        Philosophe, disponible à partir du 30 Octobre 2023.</p>
                    <p class="alert alert-danger">Réservé</p>
                </div>
            </div>
            <div class="card w-25">
                <img class="card-img-top" src="../puppies_img/photo.jpg" alt="Chiot Whippet disponible">
                <div class="card-body">
                    <h3 class="card-title">Josette</h3>
                    <p class="card-text">Jolie femelle disponible, né le 31 Juillet 2023, fille de Samourai et
                        Philosophe, disponible à partir du 30 Octobre 2023.</p>
                    <p class="alert alert-success">Disponible</p>
                </div>
            </div>


        </div>

        <?php
        /* Désactivé pour le développement
        } else {
            echo "<div class='text-center alert alert-danger'><p>Vous n'êtes pas connecté !!! </p><br><a href='./login.php'>Se connecter</a></div>";
        }*/
        ?>

    </main>

</body>

</html>