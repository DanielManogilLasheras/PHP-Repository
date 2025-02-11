<?php
session_start();
if(isset($_POST['logout'])){
    header("location: logout.php");
    exit;
}
if(isset($_POST['settings'])){
    header("location:settings.php");
}
$tipo = $_SESSION['tipo'];



?>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <p class="h4">Bienvenido, <?php echo $_SESSION['nombre'];?></p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
<div class="collapse navbar-collapse" id="navbarNav">
    <form action="entry.php" method="post" id="indexForm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <input type="submit" name="logout" value="Cerrar session" class="nav-link" aria-current="page">
            </li>
        </ul>
    </form>
</div>
</div>
</nav>
<div class="container-fluid">
<div class="row align-items-start">
<div class="card" style="width: 18rem;">
    <img src="./styles/flat.jpg" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Ver pisos</h5>
        <p class="card-text">Mira la lista de pisos disponibles a los mejores precios.</p>
        <a href="pisos.php" class="btn btn-primary">Buscar piso</a>
    </div>
    </div>
    <?php
        if($tipo === "2" || $tipo === "3"){
            echo '
                <div class="card" style="width: 18rem;">
                <img src="./styles/flat.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Vender Piso</h5>
                    <p class="card-text">Vende tu piso con nosotros!</p>
                    <a href="vender.php" class="btn btn-primary">Pon en alta tu piso</a>
                </div>
                </div>
            ';
        }
        if ($tipo ==="3"){
            echo ' 
                <div class="card" style="width: 18rem;">
                <img src="./styles/images.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Administrar usuarios</h5>
                    <a href="../backend/ad_users.php" class="btn btn-primary">Administrar usuarios</a>
                </div>
                </div>
                <div class="card" style="width: 18rem;">
                <img src="./styles/images.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Administrar pisos</h5>
                    <a href="../backend/ad_flats.php" class="btn btn-primary">Administrar pisos</a>
                </div>
                </div>
            ';
        }
    ?>
</div>
    
</div>
</body>

</html>