<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Le whippet.com</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <header>
        <h1 class="alert alert-info text-center">Bienvenue sur l'administation du site LeWhippet.com</h1>
    </header>
    <main class="w-100 d-flex flex-wrap justify-content-around">
        <h2 class="w-100 text-center mb-5">Bienvenue, vous êtes connecté en tant que <?php echo $_SESSION['username'] ?>
        </h2>
        <a href="#" class="btn btn-secondary">Modifier mes informations personnelles</a>
        <a href="./puppies.php" class="btn btn-success">Gérer les chiots</a>
        <a href="#" class="btn btn-warning">Gérer les résultats d'exposition</a>
        <a href="#" class="btn btn-info">Gérer les reproducteurs</a>
        <a href="./logout.php" class="btn btn-danger">Se déconnecter</a>

    </main>

</body>

</html>