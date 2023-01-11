<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Elevage de Lévrier Whippet LOF - La Romance des Damoiseaux">
    <title>Elevage de Lévrier Whippet LOF - La Romance des Damoiseaux</title>
    <?php
        require_once(__DIR__ . '/php/component/head-links.php');
    ?>
</head>
<body class="container-fluid">
    <header>
        <?php
            require_once(__DIR__. '/php/component/menu.php' );
        ?>
    
    </header>
    <main>
        <?php
            require_once(__DIR__ . '/php/component/bandeau-title.php');
        ?>

        <div class="index_content">
            
            <?php include_once(__DIR__ . '/php/index/bb_dispo.php') ?>
            <hr>
            <?php include_once(__DIR__ . '/php/index/result_expo.php') ?>
            <hr>

            
            
            <section class="fr3 col-12 text-center">
                <h2>Nos whippets passent à la télévision</h2>
                <iframe class="player-css" title="la romance des damoiseaux whippet chez france télévision" autoplay="1" src="//embedftv-a.akamaihd.net/33a6e5bbd3bce859a7eb7827a71d9404?muted=1" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                <p>Un grand merci à l'équipe de France 3 pour leur professionnalisme et leur intérêt pour mes loulous.</p>
            </section>
            <hr>
            <section class="index_accessories col-12 text-center">
                <h2>Retrouvez nos accessoires spécial Whippet</h2>
                <img src="accessoires-chiens/doudou_pres.jpg" alt="accesoires pour whippets" />
                <p>Les nouveaux doudous sont disponibles, expédition possible <br> N'hésitez pas à nous contacter</p>
                <a href="/chiots/articles-chiot.htm" class="btn btn-gold">Nos Accessoires</a>
            </section>
            <hr>


    </main>
    <footer>
        <?php require_once(__DIR__. '/php/component/footer.php' ); ?>
    </footer>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>