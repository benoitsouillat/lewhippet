<?php
require_once(__DIR__ . '/../../secret/connexion.php');
require_once(__DIR__ . '/../utilities/usefull_functions.php');
require_once(__DIR__ . '/../sql/users_request.php');


if (isset($_POST['username'], $_POST['password'])) {

    $email = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $bddUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $hash = $bddUser['password'];

    if (password_verify($password, $hash)) {
        session_start();
        $_SESSION['username'] = $bddUser['email'];
        $_SESSION['role'] = $bddUser['role'];
        header("Location:../gerance.php");
    } else {
        header("Location:../login.php?error=mdp");
    }
}