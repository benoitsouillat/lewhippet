<?php

include_once('../gerance.php');
$stmt = $conn->prepare(getAllRepros());
$stmt->execute();
$repros = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['id'])) {
    $stmt = $conn->prepare(getReproFromId());
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $repro = $stmt->fetch(PDO::FETCH_OBJ);
}
?>
<form action="../repros/crud.php" method="post" id='reproForm' class="form-control d-flex flex-column w-50 m-3"
    enctype="multipart/form-data">
    <?php
    if (isset($_GET['id'])) {
        echo "<input type='hidden' name='repro_id' value='{$repro->id}'>";
    } ?>
    <label for="repro_name">Nom du reproducteur :</label>
    <input name="repro_name" id="repro_name" class="form-control-sm" type="text">
    <label for="repro_sex">Sexe du reproducteur :</label>
    <select name="repro_sex" id="repro_sex" class="form-control-sm">
        <option value="femelle" selected>Femelle</option>
        <option value="male">Mâle</option>
    </select>
    <label for="repro_color">Couleur de robe :</label>
    <select name="repro_color" id="repro_color" class="form-control-sm">
        <option value="Tourterelle">Tourterelle</option>
        <option value="Bringé Bleu">Bringé Bleu</option>
        <option value="Bringé Noir">Bringé Noir</option>
        <option value="Unicolor Bleu">Unicolor Bleu</option>
        <option value="Unicolor Noir">Unicolor Noir</option>
        <option value="Fauve">Fauve</option>
        <option value="Beige">Beige</option>
    </select>
    <label for="repro_insert">Puce électronique :</label>
    <input name="repro_insert" id="repro_insert" class="form-control-sm" type="text">

    <label for="repro_description">Description :</label>
    <textarea name="repro_description" id="repro_description" class="form-control-sm"
        placeholder="Descrivez le chien"></textarea>


    <div id="repro_breeder">
        <p>Issu de la Romance des Damoiseaux ? </p>
        <input type="radio" id="breeder_yes" name="repro_breeder" value="de la Romance des damoiseaux" checked>
        <label for="breeder_yes">Oui</label>
        <input type="radio" id="breeder_no" name="repro_breeder">
        <label for="breeder_no">Non</label>
    </div>
    <label for="repro_birthdate">Date de naissance :</label>
    <input type="date" value="2000-01-01" name="repro_birthdate">
    <label for="repro_lofselect">Lien Lof Select :</label>
    <input name="repro_lofselect" id="repro_lofselect" class="form-control-sm" type="text"
        value="https://www.centrale-canine.fr/lofselect/chien/imperiale-de-la-romance-des-damoiseaux-5912533">

    <div class="reproRadios w-100 p-2">
        <p>Le reproducteur est-il testé ADN ?</p>
        <input type="radio" name="repro_adn" id="adn_yes" value="1" checked>
        <label for="adn_yes">Oui</label>
        <input type="radio" name="repro_adn" id="adn_no" value="0">
        <label for="adn_no">Non</label>
        <p>Le reproducteur est-il Champion ?</p>
        <input type="radio" name="repro_champion" id="champion_yes" value="1">
        <label for="champion_yes">Oui</label>
        <input type="radio" name="repro_champion" id="champion_no" value="0" checked>
        <label for="champion_no">Non</label>
    </div>
    <label for="main_img_path">Choisir une image d'illustration</label>
    <input type="file" name="main_img_path" id="main_img_path">

    <button type="submit" class="btn btn-success">Soumettre</button>
</form>