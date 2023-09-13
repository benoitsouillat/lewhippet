<?php

include_once('../gerance.php');

?>

<form class='w-75 text-center' method='post' action='../puppies/crud.php'>


    <?php
    echo "


    <label for='name'>Nom du chiot</label>
    <input class='form-control' name='name' id='name' type='text' value='{$puppy->name}' />
        
            
    <label for='sex'>Mâle ou Femelle</label>
    <select class='form-control' for='sex'>
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
    <textarea id='description' class='form-control'>{$puppy->description} </textarea>
    "
    ?>



    <button type="submit" class="btn btn-success">Envoyer</button>

</form>