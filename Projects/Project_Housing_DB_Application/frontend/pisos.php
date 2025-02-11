<?php
session_start();
if(isset($_POST['logout'])){
    header("location: logout.php");
    exit;
}
if (isset($_POST['login'])) {
    header("location: login.php");
}
if (isset($_POST['registro'])) {
    header("location: registro.php");
}
if (isset($_SESSION['loggedin'])){
    $boton = '<form action="" method="post"> 
    <button type="submit" href="#" name="comprar" class="card-button">Comprar</button>
    </form>
    ';
}else
{
    $boton = "";
}
?>
<html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <?php
    echo'<div class="container-fluid">';
        if(isset($_SESSION['loggedin'])){
            echo '
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <p class="h4">Bienvenido, ' . $_SESSION['nombre'] . '</p>
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
            ';
        }else{
            echo '
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../index.php">INMOBILIARIA S.L</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <form action="pisos.php" method="post" id="indexForm">
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
            ';
        }
        echo '<h3>Lista de pisos:</h3>';
        echo '<div class="row align-items-start">';
    $conexion = mysqli_connect("localhost","root","","inmobiliaria");
    $query = "SELECT * FROM pisos";
    if($result =mysqli_query($conexion,$query)){
        
        while ($row = mysqli_fetch_assoc($result)){
        echo '
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">' .$row["calle"] .', Nº: '. $row["numero"].', '.$row['cp'].'</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Zona: '.$row['zona']. ' | Espacio: ' .$row["metros"].' m2</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">Precio: ' .$row["precio"].' euros.</h6>
                '.$boton.'
            </div>
        </div>
        ';    
    }
    
    mysqli_close($conexion);
}
    echo '</div>';
    echo '</div>';
    ?>
</body>
</html>

<?php


?>