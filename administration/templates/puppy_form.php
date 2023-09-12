<?php

include_once('../gerance.php');

?>

<form class="w-75 text-center" method="post" action="../puppies/crud.php">
    <label for="name">Nom du chiot</label>
    <input class="form-control" name="name" id="name" type="text" value="
    <?php
    if (isset($puppy)) {
        echo $puppy->name;
    }
    ?>
    " />

    <button type="submit" class="btn btn-success">Envoyer</button>
    <?php

    //Créer les deux form à part ??
    if (isset($puppy)) {
    }
    ?>
</form>