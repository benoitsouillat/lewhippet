<?php
session_start();
require_once('../sql/puppies_request.php');
require_once('../utilities/usefull_functions.php');
require_once('../../secret/connexion.php');

//Mettre le logo de la Romance des Damoiseaux
define('DEFAULT_PUPPY_PATH_IMG', '../../puppies_img/default.jpg');

if (check_session_start($_SESSION)) {

    if (isset($_GET['id'])) {
        // Delete
        if (isset($_GET['delete']) && ($_GET['delete'] == true)) {
            $id = $_GET['id'];
            $imgDirectory = '../../puppies_img/';
            $arrayImg = scandir($imgDirectory);
            $regImg = '/^' . preg_quote($id, '/') . '-.*/';

            $stmt = $conn->prepare(deletePuppy($id));
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
        $stmt = $conn->prepare(getPuppyFromId($id));
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        try {
            $puppy = $stmt->fetch(PDO::FETCH_OBJ);
            include(__DIR__ . '/../templates/puppy_form.php');
        } catch (PDOException $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    } elseif (isset($_POST['name']) && $_POST['name'] != null && isset($_POST['puppy_id'])) {
        $puppy = $_POST;

        $stmt = $conn->prepare(updatePuppy());
        $stmt->bindParam(':id', $puppy['puppy_id']);
        $stmt->bindParam(':name', $puppy['name']);
        $stmt->bindParam(':sex', $puppy['sex']);
        $stmt->bindParam(':available', $puppy['available']);
        $stmt->bindParam(':description', $puppy['description']);
        $stmt->bindParam(':mother_name', $puppy['mother_name']);
        $stmt->bindParam(':mother_adn', $puppy['mother_adn']);
        $stmt->bindParam(':mother_champion', $puppy['mother_champion']);
        $file_name = $puppy['puppy_id'] . '-' . strtolower($puppy['name']);


        if (isset($_FILES['main_img_path']) && $_FILES['main_img_path']['name'] != null) {
            //Vérification d'une erreur suite à une image trop lourde
            if (isset($_FILES['main_img_path']['error']) && $_FILES['main_img_path']['error'] === 2) {

                header('Location:./crud.php?error=2&id=' . $puppy['puppy_id']);
                die();
            }
            $file_tmp = $_FILES['main_img_path']['tmp_name'];
            $file_destination = '../../puppies_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            move_uploaded_file($file_tmp, $file_destination);
            $stmt->bindValue(':main_img_path',  $file_destination);
        } else {
            $stateImg = $conn->prepare(getPuppyFromId());
            $stateImg->bindParam(':id', $puppy['puppy_id']);
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

        $puppy = $_POST;
        $stmt = $conn->prepare(createPuppy());
        $stmt->bindParam(':name', $puppy['name']);
        $stmt->bindParam(':sex', $puppy['sex']);
        $stmt->bindParam(':available', $puppy['available']);
        $stmt->bindParam(':description', $puppy['description']);
        $stmt->bindParam(':mother_name', $puppy['mother_name']);
        $stmt->bindParam(':mother_adn', $puppy['mother_adn']);
        $stmt->bindParam(':mother_champion', $puppy['mother_champion']);
        $file_destination = '../../puppies_img/default.jpg';

        $stmt_id = $conn->prepare("SELECT id from puppies");
        $stmt_id->execute();
        $id_array = $stmt_id->fetchAll(PDO::FETCH_OBJ);
        $position = end($id_array)->id + 1;

        if (isset($_FILES['main_img_path']) && $_FILES['main_img_path']['name'] != null) {
            $id_name = end($id_array)->id + 1;
            $file_name = $id_name . '-' . replace_reunion_char(replace_accent($puppy['name']));


            $file_tmp = $_FILES['main_img_path']['tmp_name'];
            $file_destination = '../../puppies_img/' . replace_reunion_char(replace_accent($file_name)) . '.jpg';
            if (move_uploaded_file($file_tmp, $file_destination)) {
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
        try {
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
