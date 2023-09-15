<?php

include_once(__DIR__ . '/../gerance.php');

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 2:
            echo "<p class='mt-4 p-2 alert alert-danger text-center'>L'image est trop lourde, il faut une image de moins de 5Mo</p>";
            break;

        default:
            echo "<p class='mt-4 p-2 alert alert-danger text-center'>Une erreur s'est produite, contactez l'administrateur du site</p>";
    }
}

?>

<form class='col-xl-4 col-md-6 col-9 text-center m-1' method='post' action='../puppies/crud.php'
    enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000">

    <?php
    if (isset($_GET['id'])) {
        echo "
    <input type='hidden' name='puppy_id' value='{$puppy->id}'>

    <label for='name' class='m-2'>Nom du chiot</label>
    <input class='form-control' name='name' id='name' type='text' value='{$puppy->name}' />
    
    <label for='sex' class='m-2' >Mâle ou Femelle</label>
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
    <label for='description' class='m-2' >Description du bébé </label>
    <textarea id='description' class='form-control' type='text' name='description'>{$puppy->description} </textarea>
    
    <label for='available' class='mt-2 mb-2' >Disponibilité : </label>
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
        <label for='main_img_path' class='m-2' >Son image principale :</label>
        <img class='col-8 col-md-6 col-lg-4' src='../{$puppy->main_img_path}' />
        <input class='m-2' type='file' name='main_img_path' value='{$puppy->main_img_path}'/>";
    } else {
    ?>
    <label for="name" class='m-2'>Nom du chiot</label>
    <input class="form-control" id="name" name="name" <?php if (isset($_GET['name'])) {
                                                                echo "value={$_GET['name']}";
                                                            };
                                                            ?> placeholder="Nom ou Numéro du chiot" />

    <label for='sex' class='m-2'>Mâle ou Femelle</label>
    <select class='form-control' for='sex' name='sex'>
        <option value='femelle'>Femelle</option>
        <option value='male'>Mâle</option>
    </select>
    <label for='description' class='m-2'>Description du bébé </label>
    <textarea id='description' class='form-control' name='description' placeholder="Entrez la description du chiot">
        <?php if (isset($_GET['description'])) {
            echo $_GET['description'];
        }
        ?>
    </textarea>

    <label for='available' class='mt-2 mb-2'>Choisir sa Disponibilité : </label>
    <select class='form-control mt-2 mb-2' for='available' id='available' name='available'>
        <option value='Disponible'>Disponible</option>
        <option value='En option'>En Option</option>
        <option value='Réservé'>Réservé</option>
    </select>
    <label for="main_img_path">Son image principale :</label>
    <input class="form-control mt-2" type="file" name="main_img_path" />
    <?php
    }
    ?>
    <button type="submit" class="btn btn-success mt-2">Envoyer</button>

</form>

</main>