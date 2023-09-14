<?php

include_once('../gerance.php');

?>

<form class='w-75 text-center' method='post' action='../puppies/crud.php' enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">

    <?php
    if (isset($_GET['id'])) {
        echo "
    <input type='hidden' name='puppy_id' value='{$puppy->id}'>

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
        echo "</select>
        <label for='main_img_path'>Son image principale :</label>
        <img class='w-25' src='../{$puppy->main_img_path}' />
        <input type='file' name='main_img_path' value='{$puppy->main_img_path}'/>";
    } else {
    ?>
    <label for="name">Nom du chiot</label>
    <input class="form-control" id="name" name="name" />

    <label for='sex'>Mâle ou Femelle</label>
    <select class='form-control' for='sex' name='sex'>
        <option value='femelle'>Femelle</option>
        <option value='male'>Mâle</option>
    </select>
    <label for='description'>Description du bébé </label>
    <textarea id='description' class='form-control' type='text' name='description'
        placeholder="Entrez la description du chiot"> </textarea>

    <label for='available'>Disponibilité : </label>
    <select class='form-control' for='available' id='available' name='available'>
        <option value='Disponible'>Disponible</option>
        <option value='En option'>En Option</option>
        <option value='Réservé'>Réservé</option>
    </select>
    <label for="main_img_path">Son image principale :</label>
    <input type="file" name="main_img_path" />
    <?php
    }
    ?>
    <button type="submit" class="btn btn-success">Envoyer</button>

</form>