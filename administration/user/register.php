<?php

define('DEFAULT_PROFILE_PATH_IMG', '/user_img/default.jpg');
require_once(__DIR__ . '/../../secret/connexion.php');
require_once(__DIR__ . '/../utilities/usefull_functions.php');
require_once(__DIR__ . '/../sql/users_request.php');

if (isset($_POST['username'], $_POST['password'])) {

    $email = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $img_profile_path = DEFAULT_PROFILE_PATH_IMG;

    $emails = $conn->query(getAllUsers())->fetchAll(PDO::FETCH_ASSOC);
    foreach ($emails as $user) {
        if ($user['email'] === $email) {
            echo "Tu peux pas t'inscrire" ?><a href="../../index.php">Sortir d'ici</a>
<?php
        }
    }
    $stmt = $conn->prepare(addUser());
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':img_profile_path', $img_profile_path);

    try {
        $stmt->execute();
        header("Location:../login.php");
    } catch (PDOException $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}
