<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription La Romance des Damoiseaux</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="important_message alert alert-danger d-flex flex-column justify-content-center align-items-center mb-5">
        <h1 class="red_message bold_message">Cette page est réservée à l'administration du site, si vous êtes arrivé ici
            par
            erreur, merci de retourner sur
            <a href="../index.php">la page d'accueil</a>
        </h1>
        <a class="btn btn-danger btn_red w-50 m-5" href="../index.php">Retourner à l'accueil</a>
    </div>
    <section class="d-flex justify-content-center">
        <form class="form_administration w-25" method="post">
            <label for="username">Adresse Email</label>
            <input class="form-control" name="username" id="username" type="email" />
            <br>
            <label for="password">Mot de passe</label>
            <input class="form-control" name="password" id="password" type="password" />
            <label for="password_verify">Vérifier le Mot de passe</label>
            <input class="form-control" name="password_verify" id="password_verify" type="password" />
            <div class="d-flex flex-row justify-content-between mt-5">
                <button type="reset" class="btn btn-secondary justify-self-end">Effacer</button>
                <button type="submit" class="btn btn-success btn-pink justify-self-end">S'inscrire</button>
            </div>'
        </form>
    </section>

</body>

</html>