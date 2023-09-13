<?php

include_once('../gerance.php');

?>

<form class='w-75 text-center' method='post' action='../puppies/crud.php'>
    <input type="hidden" name="puppy_id" value="<?php echo $puppy->id; ?>">
    <?php
    echo "
    <label for='name'>Nom du chiot</label>
    <input class='form-control' name='name' id='name' type='text' value='{$puppy->name}' />
                   
    <label for='sex'>Mâle ou Femelle</label>
    <select class='form-control' for='sex' name='sex'>
        ";
    if ($puppy->sex === 'femelle') {
        echo "
        <option value='femelle' selected>Femelle</option>
        <option value='male'>Mâle</option>
        ";
    } else {
        echo "
        <option value='femelle'>Femelle</option>
        <option value='male' selected>Mâle</option>
        ";
    }
    echo "
    </select>
    <label for='description'>Description du bébé </label>
    <textarea id='description' class='form-control' type='text' name='description'>{$puppy->description} </textarea>
    <label for='available'>Disponibilité : </label>
    <select class='form-control' for='available' id='available' name='available'>
    ";
    if ($puppy->available === 'Réservé') {
        echo "
        <option value='Disponible'>Disponible</option>
        <option value='En option'>En Option</option>
        <option value='Réservé' selected>Réservé</option>
        ";
    } elseif ($puppy->available === 'En option') {
        echo "
        <option value='Disponible'>Disponible</option>
        <option value='En option' selected>En Option</option>
        <option value='Réservé'>Réservé</option>
        ";
    } else {
        echo "
        <option value='Disponible' selected>Disponible</option>
        <option value='En option'>En Option</option>
        <option value='Réservé'>Réservé</option>
        ";
    }
    echo "</select>";
    ?>
    <button type="submit" class="btn btn-success">Envoyer</button>

</form>