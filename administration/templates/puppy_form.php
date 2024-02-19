<?php
require_once('../../database/requestPDO.php');
$pdo = new RequestPDO();

if (isset($puppy)) {
    $title = $puppy->getName();
}

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
    <input type="hidden" name="MAX_FILE_SIZE" value="15000000">

    <?php
    if (isset($_GET['id'])) {
        echo "
    <input type='hidden' name='puppy_id' value='{$puppy->getId()}'>
    <label for='name' class='m-2'>Nom du chiot</label>
    <input class='form-control' name='name' id='name' type='text' value='{$puppy->getName()}' />
    <label for='sex' class='m-2' >Mâle ou Femelle</label>
    <select class='form-control' for='sex' name='sex'>
        ";
        if ($puppy->getSex() === 'femelle') {
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
    <label for='color'>Couleur : </label>
    <input type='text' name='color' id='color' class='form-control' value='{$puppy->getColor()}'>
    <label for='description' class='m-2' >Description du bébé </label>
    <textarea id='description' class='form-control' type='text' name='description'>{$puppy->getDescription()}</textarea>
          <div class='m-4'><p>La Maman : {$puppy->getLitter()->getMother()->getName()} ";
        if ($puppy->getLitter()->getMother()->getIsAdn()) {
            echo "<span class='m-2 alert alert-info'> ADN </span>";
        }
        if ($puppy->getLitter()->getMother()->getIsChampion()) {

            echo "<span class='alert alert-info'> Championne </span>";
        }
        echo "</p></div>
    <label for='available' class='mt-2 mb-2' >Disponibilité : </label>
    <select class='form-control' for='available' id='available' name='available'>
    ";
        if ($puppy->getAvailable() === 'Réservé') {
            echo "
        <option value='Disponible'>Disponible</option>
        <option value='En option'>En Option</option>
        <option value='Réservé' selected>Réservé</option>
        ";
        } elseif ($puppy->getAvailable() === 'En option') {
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
        <label for='main_img_path' class='m-2' >Son image principale :</label><br>
        <img class='col-8 col-md-6 col-lg-4' src='{$puppy->getMainImgPath()}' />
        <input class='m-2' type='file' name='main_img_path' value='{$puppy->getMainImgPath()}'/>
        <br/>
        <label for='images[]' class='m-2'>Ajoutez des images pour son diaporama </label><br>
        <input class='m-2' type='file' name='images[]' multiple/>
        <p>Ses photos de diaporama en ligne : <br></p>
        <div class='diapo_crud_container'>
        ";
        $stmt = $pdo->connect()->prepare(getPuppyImages());
        $stmt->bindValue(':dogId', $puppy->getId());
        $stmt->execute();
        $image_diapos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($image_diapos as $image) {
            echo "
            <div class='diapo_crud'>
                <img src='{$image['path']}' alt='{$puppy->getName()}' >
                <a onClick='confirmDeleteImage({$image['id']},{$puppy->getId()})'><img src='../../images/cross_black.png' alt='Supprimer'></a>
            </div>
            ";
        }
        echo "</div>";
    } else {
    ?>
    <label for="name" class='m-2'>Nom du chiot</label>
    <input class="form-control" id="name" name="name" <?php if (isset($_GET['name'])) {
                                                                echo "value={$_GET['name']}";
                                                            };
                                                            ?> placeholder="Nom ou Numéro du chiot" required />

    <label for='sex' class='m-2'>Mâle ou Femelle</label>
    <select class='form-control' for='sex' name='sex'>
        <option value='femelle'>Femelle</option>
        <option value='male'>Mâle</option>
    </select>
    <label for='color'>Couleur : </label>
    <input type='text' name='color' id='color' class='form-control' placeholder="Couleur du chiot">
    <label for='description' class='m-2'>Description du bébé </label>
    <textarea id='description' class='form-control' name='description'
        placeholder="Entrez la description du chiot"><?php if (isset($_GET['description'])) {
                                                                                                                            echo $_GET['description'];
                                                                                                                        } ?></textarea>

    <fieldset class="border m-2">
        <label for="mother_name">La Maman</label>
        <input class="form-control border-0" type=" text" name="mother_name" placeholder="Nom de la mère" />
        <div class="form-control-sm ">
            <p>Est-elle vérifiée en ADN ?</p>
            <input type="radio" id="adn_yes" name="mother_adn" value="1" checked>
            <label for="adn_yes">Oui</label>
            <input type="radio" id="adn_no" name="mother_adn" value="0">
            <label for="adn_no">Non</label>
        </div>
        <div class="form-control-sm">
            <p>Est-elle Championne Internationale ?</p>
            <input type="radio" id="champion_yes" name="mother_champion" value="1">
            <label for="champion_yes">Oui</label>

            <input type="radio" id="champion_no" name="mother_champion" value="0" checked>
            <label for="champion_no">Non</label>
        </div>
    </fieldset>
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
    <br>
    <button type="submit" class="btn btn-success mt-2">Envoyer</button>
    <a href="../puppies.php" class="btn btn-danger mt-2">Retour aux bébés</a>

</form>

</main>