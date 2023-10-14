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

<form class="col-10 d-flex flex-column justify-content-around align-items-center" action="../litters/crud.php" enctype="multipart/form-data" method="post">
    <h3> <?php echo $litter->getMother()->getName() . ' ' . $litter->getMother()->getBreeder() . ' et ' . $litter->getFather()->getName() . ' ' . $litter->getFather()->getBreeder(); ?>
    </h3>
    <input type="hidden" name="litter_id" value="<?php echo $_GET['id'] ?>">
    <input type="hidden" name="mother_id" value="<?php echo $litter->getMother()->getId() ?>">
    <input type="hidden" name="father_id" value="<?php echo $litter->getFather()->getId() ?>">
    <input type="hidden" name="numberFemales" value="<?php echo $litter->getNumberFemales() ?>">
    <input type="hidden" name="numberMales" value="<?php echo $litter->getNumberMales() ?>">
    <fieldset class="d-flex flex-row justify-content-start align-items-center flex-wrap col-8 col-sm-6 col-md-4 col-lg-3">
        <label class="text-center col-12" for="birthdate">Date de naissance des bébés : </label>
        <input type="date" name="birthdate" class="form-control" id="birthdate" value=<?php echo $litter->getBirthdate(); ?>>
    </fieldset>
    <p>Il y'a
        <?php echo $litter->getNumberPuppies() . ' bébé(s) - (' . $litter->getNumberFemales() . ' femelles et ' . $litter->getNumberMales() . ' mâles).'; ?>
    </p>
    <fieldset class="d-flex flex-row justify-content-start align-items-center flex-wrap col-10 col-sm-6 col-md-4 col-lg-3">
        <label class="text-center col-12" for="sccNumber">Numéro de Portée</label>
        <input class="form-control" name="sccNumber" id="sccNumber" type="text" placeholder="Entrez le numéro de portée" value="<?php echo $litter->getLitterNumberSCC() ?>" required>
    </fieldset>
    <button class="btn btn-success" type="submit">Enregistrer la portée</button>
</form>
</main>