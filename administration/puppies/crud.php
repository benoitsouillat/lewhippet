<?php
session_start();
require_once('../sql/puppies_request.php');
require_once('../utilities/usefull_functions.php');
// require_once('../../secret/connexion.php');
require_once(__DIR__ . '/../classes/Puppy.php');
require_once(__DIR__ . '/../../database/requestPDO.php');
require_once(__DIR__ . '/../../php/resizer.php');

//Mettre le logo de la Romance des Damoiseaux
define('DEFAULT_PUPPY_PATH_IMG', '../../puppies_img/default.jpg');

if (check_session_start($_SESSION)) {
    $pdo = new RequestPDO();

    if (isset($_GET['id'])) {
        // Delete
        if (isset($_GET['delete']) && ($_GET['delete'] == true)) {
            $id = $_GET['id'];
            $imgDirectory = '../../puppies_img/';
            $arrayImg = scandir($imgDirectory);
            $regImg = '/^' . preg_quote($id, '/') . '-.*/';

            $stmt = $pdo->connect()->prepare(deletePuppy($id));
            $stmt->bindValue(':id', $id);
            try {
                $stmt->execute();
                foreach ($arrayImg as $img) {
                    if (preg_match($regImg, $img)) {
                        unlink($imgDirectory . $img);
                    }
                }
                header("Location:../puppies.php");
            } catch (PDOException $e) {
                echo "Une erreur s'est produite : " . $e->getMessage();
            }
        }
        // Modify
        $id = $_GET['id'];
        $stmt = $pdo->connect()->prepare(getPuppyFromId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $puppyData = $stmt->fetch(PDO::FETCH_OBJ);
            $puppy = new Puppy();
            $puppy->fillFromStdClass($puppyData);
            include(__DIR__ . '/../templates/puppy_form.php');
        } catch (PDOException $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    } elseif (isset($_POST['name']) && $_POST['name'] != null && isset($_POST['puppy_id'])) {
        if (isset($_FILES['images']) && $_FILES['images']['name'][0] != null) {
            if (isset($_FILES['images']['error']) && $_FILES['images']['error'] === 2) {
                header('Location:./crud.php?error=2&id=' . $_POST['puppy_id']);
                die();
            }
            $imagesUploadedTmp = $_FILES['images']['tmp_name'];

            foreach ($imagesUploadedTmp as $imageTmpName) {
                $prefix = substr($imageTmpName, -8, -4);
                $destination_name = $_POST['puppy_id'] . '-' . $prefix;
                $destination_folder = '../../puppies_img/';
                $destination = $destination_folder . $destination_name . '.jpg';
                move_uploaded_file($imageTmpName, $destination);
                resizeimage($destination, $destination_name, '/puppies_img/');
                $stmt = $pdo->connect()->prepare(savePuppyImages());
                $stmt->bindParam(':dogId', $_POST['puppy_id']);
                $stmt->bindParam(':path', $destination);
                $stmt->execute();

                // Retourner un message de réussite
            }
        }

        $stmt = $pdo->connect()->prepare(updatePuppy());
        $stmt->bindParam(':id', $_POST['puppy_id']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':sex', $_POST['sex']);
        $stmt->bindParam(':color', $_POST['color']);
        $stmt->bindParam(':available', $_POST['available']);
        $stmt->bindParam(':description', $_POST['description']);
        $file_name = $_POST['puppy_id'] . '-' . strtolower($_POST['name']);

        if (isset($_FILES['main_img_path']) && $_FILES['main_img_path']['name'] != null) {
            //Vérification d'une erreur suite à une image trop lourde
            if (isset($_FILES['main_img_path']['error']) && $_FILES['main_img_path']['error'] === 2) {
                header('Location:./crud.php?error=2&id=' . $_POST['puppy_id']);
                die();
            }
            $file_tmp = $_FILES['main_img_path']['tmp_name'];
            $destination_name = replace_reunion_char(replace_accent($file_name));
            $destination_folder = '/puppies_img/';
            $file_destination = '../../puppies_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            move_uploaded_file($file_tmp, $file_destination);
            resizeimage($file_destination, $destination_name, $destination_folder);
            $stmt->bindValue(':main_img_path',  $file_destination);
        } else {
            $stateImg = $pdo->connect()->prepare(getPuppyFromId());
            $stateImg->bindParam(':id', $_POST['puppy_id']);
            $stateImg->execute();
            $puppyImgDb = $stateImg->fetch(PDO::FETCH_ASSOC);
            $stmt->bindValue(':main_img_path', $puppyImgDb['main_img_path']);
        }

        try {
            $stmt->execute();
            header('Location:../puppies.php');
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    // Create
    elseif (isset($_POST['name'])) {

        $enable = 1;
        $LitterNull = 7;

        $stmt = $pdo->connect()->prepare(createPuppy());
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':sex', $_POST['sex']);
        $stmt->bindParam(':color', $_POST['color']);
        $stmt->bindParam(':available', $_POST['available']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':enable', $enable);
        $stmt->bindParam(':litter_id', $LitterNull);
        $file_destination = '../../puppies_img/default.jpg';
        // $stmt->bindParam(':mother_name', $_POST['mother_name']);
        // $stmt->bindParam(':mother_adn', $_POST['mother_adn']);
        // $stmt->bindParam(':mother_champion', $_POST['mother_champion']);
        // $stmt->bindValue(':litter_id', 0);

        $stmt_id = $pdo->connect()->prepare("SELECT id from puppies");
        $stmt_id->execute();
        $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
        $position = end($id_array)->id + 1;
        $idNumber = end($id_array)->id + 1;

        if (isset($_FILES['main_img_path']) && $_FILES['main_img_path']['name'] != null) {
            $file_name = $idNumber . '-' . replace_reunion_char(replace_accent($_POST['name']));
            $file_tmp = $_FILES['main_img_path']['tmp_name'];
            $destination_name = replace_reunion_char(replace_accent($file_name));
            $destination_folder = '/puppies_img/';
            $file_destination = '../../puppies_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            if (move_uploaded_file($file_tmp, $file_destination)) {
                resizeimage($file_destination, $destination_name, $destination_folder);
                echo "L'image a été enregistrée avec succès.";
            }
        }
        $stmt->bindValue(':main_img_path', $file_destination);
        $stmt->bindParam(':position', $position);


        //Vérification d'une erreur suite à une image trop lourde
        if (isset($_FILES['main_img_path']['error']) && $_FILES['main_img_path']['error'] === 2) {
            header('Location:../templates/puppy_form.php?error=2&name=' . $_POST['name'] . '&description=' . $_POST['description']);
            die();
        }
        if (isset($_FILES['images']) && $_FILES['images']['name'][0] != null) {
            if (isset($_FILES['images']['error']) && $_FILES['images']['error'] === 2) {
                header('Location:./crud.php?error=2&id=' . $idNumber);
                die();
            }
            $imagesUploadedTmp = $_FILES['images']['tmp_name'];

            foreach ($imagesUploadedTmp as $imageTmpName) {
                $prefix = substr($imageTmpName, -8, -4);
                $destination = '../../puppies_img/' . $idNumber . '-' . $prefix . '.jpg';
                move_uploaded_file($imageTmpName, $destination);
                $stmt = $pdo->connect()->prepare(savePuppyImages());
                $stmt->bindParam(':dogId', $idNumber);
                $stmt->bindParam(':path', $destination);
                $stmt->execute();

                // Retourner un message de réussite
            }
        }
        try {
            var_dump($stmt);
            $stmt->execute();
            header('Location:../puppies.php');
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    } else {
        include_once(__DIR__ . '/../templates/puppy_form.php');
    }
} else {
    header('Location:../logout.php');
};
