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

if (check_session_start($_SESSION)) {

?>

<form class="d-flex flex-column justify-content-around align-items-center">
    <h3> <?php echo $litter->getMother()->getName() . ' ' . $litter->getMother()->getBreeder() ?></h3>
    <label for="birthdate">Date de naissance des bébés :</label>
    <input type="date" name="birthdate" id="birthdate">
    <label for="father">Ajouter le papa :</label>
    <select name="father" class="form-control">
        <?php
            for ($i = 0, $size = count($reprosMales); $i < $size; $i++) {
                echo "<option value='{$reprosMales[$i]['name']}'>" . ucfirst($reprosMales[$i]['name']) . "</option>";
            }
            ?>


    </select>

    <button class="btn btn-success" type="submit">Créér la portée</button>
</form>

<?php
} else {
    header('Location:../logout.php');
}
?>