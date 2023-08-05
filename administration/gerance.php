<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Le whippet.com</title>
</head>

<body>
    <header>
        <h1>Bienvenue sur l'administation du site</h1>
    </header>
    <main>
        <h2>Bienvenue, vous êtes connecté en tant que <?php echo $_SESSION['username'] ?></h2>
        <a href="#" class="btn btn-info">Créer un nouveau chien</a>
        <a href="#" class="btn btn-warning">Créer un nouveau résultat d'exposition</a>
        <a href="#" class="btn btn-success">Créer un nouveau chiot</a>

    </main>

</body>

</html>