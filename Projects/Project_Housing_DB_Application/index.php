En la siguiente sesion creo una sesion para el logeo del usuario
<?php
session_start();
if (isset($_POST['login'])) {
    header("location: ./frontend/login.php");
}
if (isset($_POST['register'])) {
    header("location: ./frontend/register.php");
}


echo '
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">INMOBILIARIA S.L</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
';

echo '
<div class="collapse navbar-collapse" id="navbarNav">
    <form action="index.php" method="post" id="indexForm">
        <ul class="navbar-nav">
';
if (isset($_SESSION['activeSession'])) {
    echo '
    <h3> Bienvenido' . $_SESSION['username'];
    echo '
    <li class="nav-item">
        <input type="submit" name="register" value="Logout" class="nav-link" aria-current="page">
    </li>
    ';
} else {
    echo '
    <li class="nav-item">
    <input type="submit" name="login" value="Iniciar sesión" class="nav-link" aria-current="page">
    </li>
    <li class="nav-item">
        <input type="submit" name="register" value="Registrarse" class="nav-link" aria-current="page">
    </li>
    ';
}
echo '
</ul>
</form>
</div>
</div>
</nav>
</body>

</html>
';
