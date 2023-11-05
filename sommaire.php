<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Elevage de Lévrier Whippet LOF - La Romance des Damoiseaux">
    <title>Sommaire - Whippet LOF - La Romance des Damoiseaux</title>
    <?php
    require_once(__DIR__ . '/php/component/head-links.php');
    ?>
</head>

<body class="container-fluid">
    <header>
        <?php
        require_once(__DIR__ . '/php/component/menu.php');
        ?>

    </header>
    <main>
        <?php
        require_once(__DIR__ . '/php/component/bandeau-title.php');
        ?>
        <div class="sommaire_content">
            <section class="sommaire_bb_dispo container-fluid bg-light ">
                <div class="d-flex flex-column justify-content-center flex-wrap">
                    <h2 class="col-12">Retrouvez le carnet rose de nos chiots whippets</h2>
                    <div class="sommaire_img_bb">
                        <a href="/chiots/bb_dispo.php"> <img src="/chiots_img/illus_fichier/10032014_119.jpg" alt="Levrier Whippet Disponible"> </a>
                        <p> Nos chiots naissent et grandissent à la campagne, dans un environnement calme et propice pà
                            leur développement et leur équilibre. <br>
                            <b>Pour retrouver tous nos chiots whippets LOF disponibles :</b> <br> <a href="/chiots/bb_dispo.php" class="btn btn-pink">Cliquez ici</a>
                        </p>
                    </div>
                </div>
            </section>
            <section class="sommaire_informations">
                <h2 class="w-100">Nos conseils et renseignements</h2>
                <aside>
                    <h3 class="w-100">Pour tout savoir sur le whippet</h3>
                    <img src="/chiots_img/illus_fichier/chiot-19042009001.jpg" alt="Renseignements sur le whippet">
                    <p class="text-center">Retrouvez nos articles conseils sur le whippet, ses besoins, son caractère et
                        ses spécificités. <br>
                        <a class="btn btn-gold" href="/guide-whippet.htm">Tous nos articles</a>
                    </p>
                </aside>
                <aside>
                    <h3 class="w-100">Nous contacter pour tout renseignement</h3>
                    <img src="/chiots_img/illus_fichier/chiotschapeau.jpg" alt="Contacter la Romance des Damoiseaux">
                    <p class="text-center">N'hésitez pas à nous contacter pour plus de renseignements sur le whippet,
                        sur nos lignées et sur nos chiots disponibles <br>
                        <a class="btn btn-gold" href="/contact/contact.php">Nous contacter</a>
                    </p>
                </aside>
            </section>
        </div>
    </main>
    <footer>
        <?php require_once(__DIR__ . '/php/component/footer.php'); ?>
    </footer>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>


</html>