<?php
if (isset($litter) && $litter->getMother() !== null) {
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
    <div class="col-12 d-flex flex-row justify-content-around align-items-center flex-nowrap mb-2">
        <input type="hidden" name="mother_id" value="<?php echo $litter->getMother()->getId(); ?>">
        <h3 class="col-8 text-center"> Mariage de
            <?php echo $litter->getMother()->getName() . ' ' . $litter->getMother()->getBreeder() . ' et '; ?></h3>
        <fieldset class="font-weight-bold col-4">
            <select name="father_id" class="font-weight-bold form-control-lg">
                <?php
                for ($i = 0, $size = count($reprosMales); $i < $size; $i++) {
                    echo "<option value='{$reprosMales[$i]['id']}'>" . ucfirst($reprosMales[$i]['name']) . ' ' . $reprosMales[$i]['breeder'] . "</option>";
                }
                ?>
            </select>
        </fieldset>
    </div>
    <div class="col-8 d-flex justify-content-between">
        <fieldset class="d-flex flex-row justify-content-start align-items-center col-5">
            <label class="text-center" for="birthdate">Date de naissance des bébés : </label>
            <input type="date" name="birthdate" class="form-control" id="birthdate" value=<?php echo $litter->getBirthdate(); ?> required>
        </fieldset>
        <fieldset class="d-flex flex-column justify-content-between align-items-center col-5">

            <label for="numberPuppies">Nombre de femelle(s)</label>
            <input class="form-control" type="number" name="numberFemales" id="numberFemales" <?php echo "value={$litter->getNumberFemales()}" ?>>
            <label for="numberPuppies">Nombre de mâle(s)</label>
            <input class="form-control" type="number" name="numberMales" id="numberMales" <?php echo "value={$litter->getNumberMales()}" ?>>
            <?php $litter->setNumberPuppies($litter->getNumberFemales() + $litter->getNumberMales()); ?>
            <p><?php echo $litter->getNumberPuppies() . ' chiot(s)'; ?></p>
        </fieldset>
    </div>
    <label for="sccNumber">Numéro de Portée</label>
    <input name="sccNumber" id="sccNumber" type="text" placeholder="Entrez le numéro de portée" required>
    <button class="btn btn-success" type="submit">Créér la portée</button>
</form>
</main>