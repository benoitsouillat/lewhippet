<?php
require_once('../secret/connexion.php');
require_once('../administration/sql/puppies_request.php');
require_once('../administration/utilities/usefull_functions.php');
require_once('../php/component/display-functions.php');
require_once('../administration/classes/Puppy.php');
require_once('../administration/classes/Litter.php');


$stmtLitter = $conn->query(getAllLitters());
while ($litterData = $stmtLitter->fetch(PDO::FETCH_OBJ)) :
    $litter = new Litter;
    $litter->fillFromStdClass($litterData, $conn);

    echo "<div class='litters-container'>
                            <h4>Naissance des bébés de {$litter->getMother()->getName()} et de {$litter->getFather()->getName()} </h4>
                                <div class='parents'>
                                    <div class='mother w-50'><section>
                                        <img loading='lazy' src='{$litter->getMother()->getMainImgPath()}' alt='{$litter->getMother()->getName()}'>
                                        <p><b>{$litter->getMother()->getName()}</b><br> {$litter->getMother()->getBreeder()}</p>
                                        <p>Couleur : {$litter->getMother()->getColor()}</p>
                                        <p>Puce : {$litter->getMother()->getInsert()}</p>
                                        <p>{$litter->getMother()->getDescription()}</p>";

    echo "<div class='pills'><a class='lof-select-link' href='{$litter->getMother()->getLofselect()}' target='_blank'>Pedigree Lof Select</a>";
    if ($litter->getMother()->getIsAdn() || $litter->getMother()->getIsChampion()) {
        if ($litter->getMother()->getIsAdn()) {
            echo "<span class='adn-pill'> ADN Validée </span>";
        }
        if ($litter->getMother()->getIsChampion()) {
            echo "<span class='champion-pill'> Championnat Obtenu </span>";
        }
        echo "</div>";
    }

    echo " </section></div>
   <div class='father w-50'>
     <section>
     <img loading='lazy' src='{$litter->getFather()->getMainImgPath()}' alt='{$litter->getFather()->getName()}'>
        <p><b>{$litter->getFather()->getName()}</b><br> {$litter->getFather()->getBreeder()}</p>
        <p>Couleur : {$litter->getFather()->getColor()}</p>
        <p>Puce : {$litter->getFather()->getInsert()}</p>
        <p>{$litter->getFather()->getDescription()}</p> ";


    echo "<div class='pills'>
        <a class='lof-select-link' href='{$litter->getFather()->getLofselect()}' target='_blank'>Pedigree Lof Select</a>";
    if ($litter->getFather()->getIsAdn() || $litter->getFather()->getIsChampion()) {
        if ($litter->getFather()->getIsAdn()) {
            echo "<span class='adn-pill'> ADN Validée </span>";
        }
        if ($litter->getFather()->getIsChampion()) {
            echo "<span class='champion-pill'> Championnat Obtenu </span>";
        }
        echo "</div>";
    }
    echo " </section></div>
                                </div>
                                <p class='col-12 text-center'>{$litter->getNumberPuppies()} bébés sont nés ce " .
        trad_month(date('d F Y', strtotime($litter->getBirthdate()))) . ", {$litter->getNumberFemales()} femelle(s) et {$litter->getNumberMales()} mâle(s).</p>
                                ";


    $stmtPuppy = $conn->prepare(getAllPuppiesByPositionAndLitter());
    $stmtPuppy->bindValue(':litter_id', $litter->getId());
    $stmtPuppy->execute();

    while ($puppyData = $stmtPuppy->fetch(PDO::FETCH_OBJ)) :

        $puppy = new Puppy;
        $puppy->fillFromStdClass($puppyData, $conn);
        $availableColor = getAvailableColor($puppy->getAvailable());
        $sexColor = getSexColor($puppy->getSex());

        $stmtForPuppyImages = $conn->prepare(getPuppyImages());
        $stmtForPuppyImages->bindParam(':dogId', $puppyData->id);
        $stmtForPuppyImages->execute();
        $puppyImages = $stmtForPuppyImages->fetchAll(PDO::FETCH_ASSOC);


        if ($puppy->getEnable() == true) {
            echo "<div class='card'>
                                <figure class='m-0 p-0'>
                                    <div class='diapo-container justify-content-center' data-speed='3500' data-dog-id={$puppyData->id}>
                                        <div class='diapo diapo-{$puppyData->id}'>
                                        <img class='m-0 p-0 w-100' src='{$puppy->getMainImgPath()}'
                                        alt='Chiot Whippet Disponible' />
                                        ";
            foreach ($puppyImages as $image) {
                echo "<img src='{$image['path']}' alt='chiot disponible' class='m-0 p-0 w-100' loading='lazy'>";
            }
            if (isset($puppyImages[0]) && $puppyImages[0]['path'] != null) {
                echo "<img class='m-0 p-0 w-100' src='{$puppy->getMainImgPath()}'
                                                alt='Chiot Whippet Disponible' loading='lazy'/>
                                        </div>
                                    </div>
                                    <div class='arrow-div'>
                                        <button class='left-arrow bg-transparent border-0'>
                                            <span class='bi bi-caret-left bi-caret-left-{$puppy->getId()} text-light'></span>
                                        </button>
                                        <button class='right-arrow bg-transparent border-0'>
                                            <span class='bi bi-caret-right bi-caret-right-{$puppy->getId()} text-light'></span>
                                        </button>
                                    </div>";
            } else {
                echo "</div>
                                    </div>";
            }
            echo "
                                    <figcaption class='m-0 p-0'>
                                        <div class='d-flex flex-row justify-content-around align-items-center pr-4 pl-4 mt-3 mb-3 labels'>
                                            <h4>";

            echo "<span class='text-center'>{$puppy->getName()} </span>";
            if ($puppy->getSex() === 'Male' || $puppy->getSex() === 'male') {
                echo " <i class='bi bi-gender-male'> </i> ";
            } else {
                echo " <i class='bi bi-gender-female'> </i>";
            }
            echo "</h4>
                                        <p class='alert alert-" . $availableColor . "'> {$puppy->getAvailable()}</p>
                                    </div><p class='description'>{$puppy->getDescription()}</p>
                                    </figcation>
                                    </figure></div>";
        }
    endwhile;
    echo "</div>";
endwhile;
