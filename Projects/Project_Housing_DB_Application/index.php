<?php
session_start();
if(isset($_SESSION['loggedin'])){
    header("location: ./frontend/entry.php");
}
if (isset($_POST['login'])) {
    header("location: ./frontend/login.php");
}
if (isset($_POST['registro'])) {
    header("location: ./frontend/registro.php");
}
?>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./frontend/styles/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">INMOBILIARIA S.L</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form action="index.php" method="post" id="indexForm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <input type="submit" name="login" value="Iniciar sesión" class="nav-link" aria-current="page">
                        </li>
                        <li class="nav-item">
                            <input type="submit" name="registro" value="Registrarse" class="nav-link" aria-current="page">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <div class="card" style="width: 18rem;">
        <img src="./frontend/styles/flat.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Ver pisos</h5>
            <p class="card-text">Mira la lista de pisos disponibles a los mejores precios.</p>
            <a href="./frontend/pisos.php" class="btn btn-primary">Buscar piso</a>
        </div>
        </div>
    </main>
</body>
</html>

