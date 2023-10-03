<?php

if (isset($litter)) {
    $title = $litter->getMother()->getName();
}

include_once(__DIR__ . '/../gerance.php');

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        default:
            echo "<p class='mt-4 p-2 alert alert-danger text-center'>Une erreur s'est produite, contactez l'administrateur du site</p>";
    }
}
?>

<form class="d-flex flex-column justify-content-around align-items-center" action="../litters/crud.php"
    enctype="multipart/form-data" method="post">
    <h3> <?php echo $litter->getMother()->getName() . ' ' . $litter->getMother()->getBreeder() ?></h3>
    <input type="hidden" name="mother_id" value="<?php echo $litter->getMother()->getId() ?>">
    <input type="hidden" name="father_id" value="<?php echo $litter->getFather()->getId() ?>">
    <fieldset class="d-flex flex-row justify-content-around align-items-center col-12">
        <label for="birthdate">Date de naissance des bébés :</label>
        <input type="date" name="birthdate" value=<?php echo $litter->getBirthdate(); ?> name="birthdate"
            id="birthdate">
    </fieldset>

    <p>Le Papa : <?php echo $litter->getFather()->getName();
                    ?></p>

    <p>Il y'a <?php echo $litter->getNumberPuppies() . ' bébé(s)'; ?>
    </p>
    <label for="sccNumber">Numéro de Portée</label>
    <input name="sccNumber" id="sccNumber" type="text" value="<?php echo $litter->getLitterNumberSCC() ?>"
        placeholder="Entrez le numéro de portée" required>
    <button class="btn btn-success" type="submit">Enregistrer la portée</button>
</form>
</main>