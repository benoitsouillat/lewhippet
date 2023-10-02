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

<form class="d-flex flex-column justify-content-around align-items-center" action="../litters/crud.php" enctype="multipart/form-data">
    <h3> <?php echo $litter->getMother()->getName() . ' ' . $litter->getMother()->getBreeder() ?></h3>
    <fieldset class="d-flex flex-row justify-content-around align-items-center col-12">
        <label for="birthdate">Date de naissance des bébés :</label>
        <input type="date" value=<?php echo $litter->getBirthdate(); ?> name="birthdate" id="birthdate">
    </fieldset>
    <fieldset class="d-flex flex-row justify-content-around align-items-center col-12">
        <legend>Le Papa : </legend>
        <select name="father" class="form-control">
            <?php
            for ($i = 0, $size = count($reprosMales); $i < $size; $i++) {
                echo "<option value='{$reprosMales[$i]['name']}'>" . ucfirst($reprosMales[$i]['name']) . "</option>";
            }
            ?>
        </select>
    </fieldset>
    <label for="numberPuppies">Nombre de chiots</label>
    <input type="number" name="numberPuppies" id="numberPuppies">
    <label for="numberPuppies">Nombre de mâles</label>
    <input type="number" name="numberPuppies" id="numberPuppies">
    <?php $litter->setNumberFemales($litter->getNumberPuppies(), $litter->getNumberMales()); ?>
    <p><?php echo $litter->getNumberFemales() . ' femelle(s)'; ?>
    </p>
    <button class="btn btn-success" type="submit">Créér la portée</button>
</form>