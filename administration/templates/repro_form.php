<?php

require_once('../classes/Repro.php');
$stmt = $conn->prepare(getAllRepros());
$stmt->execute();
$repros = $stmt->fetchAll(PDO::FETCH_OBJ);
$title = $repro->getName();



include_once('../gerance.php');
?>
<form action="../repros/crud.php" method="post" id='reproForm' class="form-control d-flex flex-column w-50 m-3" enctype="multipart/form-data">
    <?php
    if (isset($_GET['id'])) {
        echo "<input type='hidden' name='repro_id' value='{$_GET['id']}'>";
        echo "<input type='hidden' name='repro_img' value='{$repro->getMainImgPath()}'>";
    } ?>
    <label for="repro_name">Nom du reproducteur :</label>
    <input name="repro_name" id="repro_name" class="form-control-sm" type="text" placeholder="Nom du chien" value="<?php echo $repro->getName(); ?>">
    <label for="repro_sex">Sexe du reproducteur :</label>
    <select name="repro_sex" id="repro_sex" class="form-control-sm">
        <option value="femelle" <?php echo ($repro->getSex() === 'femelle') ? 'selected' : NULL ?>>Femelle
        </option>
        <option value="male" <?php echo ($repro->getSex() === 'male') ? 'selected' : NULL ?>>Mâle</option>
    </select>
    <label for="repro_color">Couleur de robe :</label>
    <input type="text" name="repro_color" id="repro_color" class="form-control-sm" value="<?php echo $repro->getColor(); ?>">
    <label for="repro_insert">Puce électronique :</label>
    <input name="repro_insert" id="repro_insert" class="form-control-sm" placeholder="Numéro de Puce" type="text" value="<?php echo $repro->getInsert() ?>">

    <label for="repro_description">Description :</label>
    <textarea name="repro_description" id="repro_description" class="form-control-sm" placeholder="Décrivez le chien"><?php echo $repro->getDescription() ?></textarea>


    <div id="repro_breeder">
        <p>Issu de la Romance des Damoiseaux ? </p>
        <input type="radio" id="breeder_yes" name="repro_breeder" <?php echo ($repro->getBreeder() === 'de la Romance des Damoiseaux' || $repro->getBreeder() === '') ? 'value="de la Romance des Damoiseaux" checked' : 'value="de la Romance des Damoiseaux"'  ?>>
        <label for="breeder_yes">Oui</label>
        <input type="radio" id="breeder_no" name="repro_breeder" <?php echo ($repro->getBreeder() !== 'de la Romance des Damoiseaux' && $repro->getBreeder() !== '') ? "value='{$repro->getBreeder()}' checked" : NULL ?>>
        <label for="breeder_no">Non</label>
    </div>
    <label for="repro_birthdate">Date de naissance :</label>
    <input type="date" value="<?php echo $repro->getBirthdate() ?>" name="repro_birthdate">
    <label for="repro_lofselect">Lien Lof Select :</label>
    <input name="repro_lofselect" id="repro_lofselect" class="form-control-sm" type="text" value=<?php echo $repro->getLofselect() ?>>

    <div class="text-center reproRadios w-100 p-2">
        <p>Le reproducteur est-il testé ADN ?</p>
        <input type="radio" name="repro_adn" id="adn_yes" value="1" <?php echo ($repro->getIsAdn() ? "checked" : null) ?> checked>
        <label for="adn_yes">Oui</label>
        <input type="radio" name="repro_adn" id="adn_no" value="0" <?php echo ($repro->getIsAdn() ? null : 'checked') ?>>
        <label for="adn_no">Non</label>
        <p>Le reproducteur est-il Champion ?</p>
        <input type="radio" name="repro_champion" id="champion_yes" value="1" <?php echo ($repro->getIsChampion() ? 'checked' : null) ?>>
        <label for="champion_yes">Oui</label>
        <input type="radio" name="repro_champion" id="champion_no" value="0" <?php echo ($repro->getIsChampion() ? null : 'checked') ?>>
        <label for="champion_no">Non</label>
    </div>
    <div class="d-flex flex-column justify-content-start align-items-center mt-2">
        <label class="text-center w-100" for="main_img_path">Choisir une image d'illustration</label>
        <input class="text-center m-2 " type="file" name="main_img_path" id="main_img_path" value="<?php echo $repro->getMainImgPath() ?>">
        <!-- <label for='repro_multi_images[]'>Ajoutez plusieurs photos pour ce reproducteur</label>
    <input type="file" name="repro_multi_images[]" id="multi_images" multiple> -->
    </div>
    <button type="submit" class="btn btn-success">Soumettre</button>
</form>