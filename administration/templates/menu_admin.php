<body>
    <header>
        <h1 class="alert alert-info text-center">Bienvenue sur l'administation du site LeWhippet.com</h1>
    </header>
    <main class="w-100 d-flex flex-wrap justify-content-around">
        <h2 class="w-100 text-center mb-5">Bienvenue, vous êtes connecté en tant que <?php echo $_SESSION['username'] ?>
        </h2>
        <a href="#" class="btn btn-secondary">Modifier mes informations personnelles</a>
        <a href="../puppies.php" class="btn btn-success">Gérer les chiots</a>
        <a href="#" class="btn btn-warning">Gérer les résultats d'exposition</a>
        <a href="#" class="btn btn-info">Gérer les reproducteurs</a>
        <a href="./logout.php" class="btn btn-danger">Se déconnecter</a>

    </main>

</body>