<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location:./logout.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($title) && $title !== null) {
            echo $title . ' - ';
        }
        ?>Administration Le whippet.com</title>

    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Favicon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src='../../script/admin.js' type='text/javascript' defer></script>
    <!-- fontAwesome Icon -->
    <script src="https://kit.fontawesome.com/5944b63bf2.js" crossorigin="anonymous" defer></script>

</head>

<?php
include_once(__DIR__ . '/templates/menu_admin.php');

?>

</html>