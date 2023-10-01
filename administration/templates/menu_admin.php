<body>
    <header class="d-flex flex-column justify-content-center">
        <h1 class="alert alert-info text-center m-0">Bienvenue sur l'administation du site LeWhippet.com</h1>
        <p class="w-50 text-right align-self-end alert alert-success p-1 m-0">Connecté en tant que :
            <?php echo $_SESSION['username'] ?></p>
        <div class="w-100 d-flex flex-wrap justify-content-around mt-3">
            <a href="../../administration/puppies.php" class="btn btn-success mb-1">Gérer
                les chiots</a>
            <!--         
                <a href="#" class="btn btn-secondary mb-1">Modifier mon profil</a>
            <a href="#" class="btn btn-warning mb-1">Gérer les résultats d'exposition</a>
        -->
            <a href="../../administration/repros.php" class="btn btn-primary mb-1">Gérer les reproducteurs</a>
            <a href="../../administration/logout.php" class='btn btn-danger mb-1'>Se
                déconnecter</a>

        </div>
    </header>
    <main class="w-100 d-flex flex-column justify-content-center align-items-center">


</body>