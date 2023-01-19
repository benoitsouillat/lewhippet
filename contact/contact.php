<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <meta name="description" content="Contacter la Romance des Damoiseaux - Elevage de Whippet LOF">
        <title>La Romance des Damoiseaux - Contactez-nous</title>
        <link media="all" type="text/css" rel="stylesheet" href="../script/style.css" />
        
        <?php
            require_once(__DIR__ . '../../php/component/head-links.php');
        ?>
        <link media="all" type="text/css" rel="stylesheet" href="./contact.css" />
        
    </head>
    <body class="container-fluid">
        <header>
            <?php
            require_once(__DIR__. '../../php/component/menu.php' );
            ?>
        </header>
        <main>
            <?php
                require_once(__DIR__ . '../../php/component/bandeau-title.php');
            ?>
            <div class="content">
                <h3 class="w-100 text-center"> Contactez-nous</h3>
                <div class="contact_buttons">
                    <a class="btn btn-pink fa fa-phone" href="tel:+33609260130" > Appelez-Nous </a>
                    <a class="btn btn-pink fa fa-facebook-square" href="https://www.facebook.com/laromancedes.damoiseaux.9" target="_blank" > Facebook </a>
                    <a class="btn btn-pink fa fa-map-marker" href="#g_map" > Où sommes-nous </a>
                    <a class="btn btn-pink fa fa-star" href="https://g.page/r/CSFB1Pf0OoT8EAg/review" target="_blank"> Notez-nous </a>
                    <a class="btn btn-pink fa fa-envelope" href="mailto:laromancedesdamoiseaux@gmail.com" > Email </a>
                    <a class="btn btn-pink fas fa-pencil-alt" href="#adresse" > Nous écrire </a>
                </div>
                
                <section class="where_is_container">
                    <h4>Où sommes-nous ?</h4>
                    <div class="where_is_content">
                        <div class="diapo_contact">
                            <div class="carousel slide carousel-fade" data-ride="carousel" data-pause="false" data-interval="8000">
                                <div class="carousel-inner">
                                    <div class="carousel-item">
                                        <img src="./img/lady.JPG" alt="La Romance des Damoiseaux - Elevage Whippet">
                                        <div class="carousel-caption">
                                            <p>Lady di de la Romance des Damoiseaux</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./img/love.JPG" alt="La Romance des Damoiseaux - Elevage Whippet">
                                        <div class="carousel-caption">
                                            <p>Mam'zelle et Monseigneur de la Romance des Damoiseaux</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./img/pepette.jpg" alt="La Romance des Damoiseaux - Elevage Whippet">
                                        <div class="carousel-caption">
                                            <p>Impériale de la Romance des Damoiseaux</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item active">
                                        <img src="./img/jeunefille.jpg" alt="La Romance des Damoiseaux - Elevage Whippet" />
                                        <div class="carousel-caption">
                                            <p>Jeune-Fille de la Romance des Damoiseaux</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="g_map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11179.077149975514!2d1.607177!3d45.5348481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfc843af4f7d44121!2sLa%20Romance%20des%20Damoiseaux!5e0!3m2!1sfr!2sfr!4v1642944738871!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
                            <br/>
                            <p>4 Route du conseiller 19510 LAMONGERIE <br>( Corrèze - 19 )</p>
                        </div>
                    </div>
                </section>
                <div class="div_address" id="adresse">
                    <address>
                        <h4>Sabine Bourget</h4>
                        <p>La Romance des Damoiseaux</p>
                        <p>4 Route du conseiller<br/> 19510 Lamongerie </p>
                        <p>06 09 26 01 30</p>
                        <p>laromancedesdamoiseaux@gmail.com</p>
                    </address>
                    <img src="./img/orthense.JPG" alt="Orthense de la romance des damoiseaux, superbe whippet" />
                </div>
            </div>
        </main>
        <footer>
            <?php
                include_once (__DIR__ . '../../php/component/footer.php')
            ?>
        </footer>
        <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>