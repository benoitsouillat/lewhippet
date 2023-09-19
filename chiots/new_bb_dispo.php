<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Chiots Whippet LOF à vendre - Découvrez les chiots whippet de la romance des damoiseaux">
    <title>CHIOTS WHIPPET LOF A VENDRE | Découvrez les chiots de la romance des damoiseaux</title>
    <?php
    require_once(__DIR__ . '../../php/component/head-links.php');
    ?>
</head>

<body class="container-fluid">
    <header>
        <?php
        require_once(__DIR__ . '../../php/component/menu.php');
        ?>
    </header>
    <main>
        <?php
        require_once(__DIR__ . '../../php/component/bandeau-title.php');
        ?>
        <div class="journal_puppy">
            <h3>Bienvenue dans le journal des bébés de la Romance des damoiseaux</h3>
            <h4>Voici nos chiots Whippet Disponibles</h4>
        </div>

        <div class="puppy_dispo">
            <h5>Chiots Whippet Mâles et Femelles disponibles <span>(Photos et Vidéos à la demande)</span></h5>
            <p>Nos dernières naissances des bébés whippet</p>
        </div>
        <div class="puppies_container">
            <section id="disponible" class="section_litter">
                <h3>Nos chiots Whippet disponibles</h3>
                <!--                 <div>
                    <?php
                    //   include './highlight-puppy/highlight-schema.php';
                    ?>
                </div> -->
                <hr>
                <div class="gallery">
                    <figure>
                        <video autoplay controls muted class="puppies_img xl">
                            <source src="/chiots_img/2022/repas.mp4" type="video/mp4">
                            Pour voir la vidéo, mettez à jour votre navigateur ou installez Google Chrome
                        </video>
                        <br>
                        <br>
                        <figcaption>Premier Repas pour nos bébés !! </figcaption>
                    </figure>
                    <section class="col-12 gallery_php">
                        <div class="card col-10 col-md-5 col-xl-3">
                            <figure class="m-0 p-0">
                                <img class="m-0 p-0 w-100" src="../puppies_img/default.jpg" alt="Chiot Whippet Disponible et Test HTML" />
                                <figcaption class="m-0 p-0">
                                    <div class="d-flex flex-row justify-content-around align-items-center pr-4 pl-4 mt-3 mb-3">
                                        <h4 class=""><span class="badge bg-light badge-blue">Male N°2</span>
                                        </h4>
                                        <p> <span class="badge bg-warning">En Option</span></p>
                                    </div>
                                    <p class="description text-left">Issu de Chienne</p>
                                    <p class="description">Ici est la version HTML écrite en brut</p>
                                </figcaption>
                            </figure>
                        </div>


                        <?php
                        require_once('../secret/connexion.php');
                        require_once('../administration/sql/puppies_request.php');

                        $stmt = $conn->query(getAllPuppies());
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                            /*

                        $pathToDir = $_SERVER['DOCUMENT_ROOT'] . '/' . 'administration/' . $row['main_img_path'];
                        var_dump($pathToDir);

                        $width = getimagesize('./puppies_img/' . $pathToDir)[0];
                        $height = getimagesize('./'  . $pathToDir)[1];

                        if ($width > $height) {*/


                            echo "
                        <div class='card col-10 col-md-5 col-xl-3'>
                        <figure class='m-0 p-0'>
                            <img class='m-0 p-0 w-100' src='{$row['main_img_path']}'
                                alt='Chiot Whippet Disponible et Test HTML' />
                            <figcaption class='m-0 p-0'>
                                <div
                                    class='d-flex flex-row justify-content-around align-items-center pr-4 pl-4 mt-3 mb-3'>
                                    <h4 class=''><span class='badge bg-light badge-blue'>{$row['name']}</span>
                                    </h4>
                                    <p> <span class='badge bg-warning'>{$row['available']}</span></p>
                                </div>
                                <p class='description text-left'>Issu de " . ucfirst($row['description']) . "</p>
                                <p class='description'>{$row['description']}</p>
                            </figcaption>
                        </figure>
                    </div>
                            ";

                        endwhile;
                        ?>
                    </section>

                </div>

                <br>
                <div class="puppy_dispo">
                    <h5>Contactez nous au 06.09.26.01.30</h5>
                </div>
                <section id="next_naissance">
                    <h5>NOS FUTURES NAISSANCES DE WHIPPET</h5>
                    <p>Les pré-réservations
                        officielles sont prisent en compte uniquement avec acompte versé par chèque ou par virement
                        bancaire.
                    </p>
                    <p class="center w-100 mt-3">Pour une pré-réservation, merci de me contacter par email :
                        <a href="mailto:laromancedesdamoiseaux@gmail.com">laromancedesdamoiseaux@gmail.com</a>
                        ou par téléphone :
                        <a href="tel:+33609260130">06.09.26.01.30</a>
                    </p>
                    <div class="vente_dist">
                        <p class="center">
                            L&nbsp;information sur les prix est obligatoire quelles que soient les formes de
                            vente&nbsp;:
                            sur place, à distance (correspondance, Internet)
                            code de la consommation et inspection des fraudes
                        </p>
                    </div>
                    <hr>
                </section>
                <section id="puppies_articles_container">
                    <h5>Mon expérience de 33 ans de whippet à votre service</h5>
                    <p>Nous avons plusieurs références sur place à vous proposer, n'hésitez pas à nous demander conseil
                        <br>
                        Possibilité d'expédier votre commande par colissimo. Demandez conseils au 06.09.26.01.30 (sms de
                        préférence).<br>
                    </p>
                    <a class="btn btn-pink" href="/chiots/articles-chiot.htm">Les accessoires adaptés à votre
                        whippet</a>
                    <div class="puppies_articles_box">
                        <div class="puppies_articles_img">
                            <img class="img_medium_vertical" src="/accessoires-chiens/images/nouvelle%20collection%20accessoires%20whippet/IMG_2374.JPG" alt="whippet et accessoires">
                            <img class="img_medium_vertical" src="/accessoires-chiens/images/nouvelle%20collection%20accessoires%20whippet/IMG_2250.JPG" alt="whippet et accessoires">
                            <img class="img_medium_vertical" src="/accessoires-chiens/images/nouvelle%20collection%20accessoires%20whippet/IMG_2212.JPG" alt="whippet et accessoires">
                        </div>
                        <div class="puppies_articles_img">
                            <img class="img_medium_horizontal" src="/accessoires-chiens/images/nouvelle%20collection%20accessoires%20whippet/IMG_3080.JPG" alt="whippet et accessoires">
                            <img class="img_medium_horizontal" src="/accessoires-chiens/images/nouvelle%20collection%20accessoires%20whippet/IMG_3007.JPG" alt="whippet et accessoires"><br>
                        </div>
                        <p>
                            Jouets de 5 à 26 euros selon la référence, les
                            dodos de 43 à 100 euros selon le modèle choisi<br>
                            et 75 à 120 euros pour les doudounes et manteaux
                            lévrier
                        </p>
                    </div>
                </section>

                <div class="puppy_infos">
                    <section class="section_infos">
                        <h6>NOS DEPLACEMENTS</h6>
                        <p>
                            Nous nous déplaçons dans toute la France et parfois à l'étranger pour les expositions
                            canines ou voyages
                            personnels c'est pourquoi nous proposons à notre clientèle de vous retrouvez plus près de
                            chez vous si besoin
                            et si l'itinéraire nous le permet.
                            Ainsi les chiots, préalablement réservés, voyagent avec nous en sécurité et pourront vous
                            rejoindre plus
                            facilement. <br>
                            Aucune livraison par transport Sernam n 'est envisageable. <br>
                            <b>PROCHAINS DEPLACEMENTS POSSIBLES : </b> Région parisienne, Clermont Ferrand, Moulins,
                            Toulouse ou Bordeaux
                        </p>
                    </section>
                    <section class="section_infos">
                        <h6>NOS TARIFS</h6>
                        <p>
                            Pour une information transparente, tous nos prix sont indiqués et détaillés en bas des pages
                            de chaque portée.
                            Le tarif se situe entre 1300 et 1600 euros en moyenne et peut varier selon la qualité,
                            l'origine et la rareté
                            du coloris.
                            à partir de 2000 euros pour une femelle bleue <br>
                            Nos chiots sont tous en bonne santé, inscrits au LOF, identifiés, vaccinés, vermifugés et
                            ergotés. <br>
                            Nous proposons des facilités de paiement qui seront notifiés lors de la réservation ou de la
                            vente. <br>
                            Les réservations seront officielles uniquement une fois l acompte encaissé. <br>
                        </p>
                    </section>
                    <section class="section_infos">
                        <h6>NOS SERVICES APRES VENTE</h6>
                        <p>Je mets mon expérience à votre service en restant disponible et à votre écoute pour tous
                            conseils et
                            renseignements complémentaires
                            suite à l'achat d'un chiot de mon élevage. Je connais parfaitement mes lignées et peux ainsi
                            répondre
                            précisément à toutes vos questions
                            concernant l'éducation, l'alimentation, le comportement ou les différents soins de votre
                            sublime compagnon.
                            <br>
                            Je propose également la garde de vos whippets issus de mon élevage lors de vos déplacements
                            ( départ en
                            vacances par exemple )
                            ainsi votre chien sera en confiance en retrouvant ses repères d'enfant et vous pourrez
                            profiter de vos
                            vacances.
                        </p>
                    </section>
                    <p>Pour réserver un chiot whippet, contactez-nous au <b>06 09 26 01 30</b></p>
                </div>
                <article id="male_femelle">
                    <h2>Mâle ou Femelle : Que choisir ??</h2>
                    <div>
                        <img src="/chiots_img/illus_fichier/chiotschapeau.jpg" alt="whippet calme et équilibré joue avec un chapeau">
                        <p>Nos chiots whippets sont calmes et équilibrés, ils évoluent dans un environnement
                            sain qui leur permet de s'adapter facilement à leur nouvelle vie.</p>
                    </div>
                    <a href="/guide-pratique/male-femelle.htm" class="btn btn-pink">En savoir plus</a>
                </article>
                <article id="choose_damoiseaux">
                    <h2>Choisir un chiot whippet <br> de la Romance des Damoiseaux </h2>
                    <p>
                        <img src="/chiots_img/illus_fichier/chiot-19042009001.jpg" alt="chiot whippet avec un chapeau">
                        En choisissant un chiot whippet dans notre élevage vous avez l'assurance que votre bébé a
                        bénéficié de toute
                        notre affection, du confort et de tous les soins depuis sa naissance et qu'il
                        a grandi avec sa mère et ses frères et sœurs jusqu'à huit semaines dans un environnement
                        familial sain, propre,
                        calme et propice à son développement.
                    </p>
                    <p>
                        Pour vous garantir la qualité, la vitalité et la sociabilité de nos chiots nous choisissons les
                        parents
                        essentiellement en fonction des origines (lignées beauté exclusivement) et des caractères qui se
                        doivent d'être
                        représentatifs du standard de la race du whippet et conforme à nos attentes.</p>
                    <p>Nos chiots whippet sont issus de lignées prestigieuses que nous connaissons parfaitement, que
                        nous aimons et
                        que nous utilisons avec succés depuis maintenant plusieurs générations.</p>
                    <img src="/chiots_img/illus_fichier/chiotFleur.jpg" alt="chiot disponible avec une fleur">
                    <p>
                        Grâce à cette sélection mais aussi parce que nous élevons tous nos bébés avec amour dans un
                        environnement
                        propice vous avez la certitude d'avoir un joli chiot, sociable et plein de vitalité
                        qui grandira à vos cotés et qui vous accompagnera pendant de belles et longues années.
                        <br>Le chiot whippet aime le contact, rien de tel qu'un moment sur vos genoux pour nouer des
                        liens profonds.
                    </p>
                    <p>Pour finir sachez aussi que comme pour tous les propriétaires de "damoiseaux" nous serons à vos
                        cotés pour vous
                        conseiller avant, pendant et aprés.. <br>
                        Depuis plus de trente ans nous élevons des whippets et nous sommes toujours disponibles pour
                        eux.
                        Le bien être de nos whippets et la satisfaction des maîtres est une priorité absolue et il est
                        de notre devoir
                        d'informer, de vous conseiller et de vous accompagner car nous savons qu'un maître averti vivra
                        heureux et en
                        harmonie avec son whippet.</p>
                    <br><br>
                    <span>Sabine Bourget</span>
                </article>
                <div class="div_rose">
                    <address>
                        <h4>La Romance des Damoiseaux</h4>
                        <p>LA FAYE <br> 19510 LAMONGERIE</p>
                        <p>Elevage passion de Whippet, pour tout savoir sur le whippet</p>
                        <a href="tel:+33609260130">06.09.26.01.30</a> <br>
                        <a href="mailto:laromancedesdamoiseaux@gmail.com">laromancedesdamoiseaux@gmail.com</a>
                    </address>
                </div>
    </main>
    <footer>
        <?php require_once(__DIR__ . '../../php/component/footer.php'); ?>
    </footer>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>