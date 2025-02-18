<?php
include "../db/db.php";
$error = "";
if (isset($_POST['loginbtn'])) {
    $email = htmlspecialchars($_POST['emailLogin']);
    $password = htmlspecialchars($_POST['passLogin']);
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("Error en la conexión con la base de datos");
    if ($query = $conexion->prepare("SELECT * FROM usuario WHERE correo = ?")) {
        $query->bind_param("s", $email);
        $query->execute();
    } else {
        $error = "Error en base de datos, inténtelo más tarde.";
    }
    $query->store_result();
    if ($query->num_rows > 0) {
        $query->bind_result($idQ, $nombreQ, $emailQ, $passwordQ, $tipoQ);
        $query->fetch();
    }
    if (password_verify($password, $passwordQ)) {
        session_start();
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['nombre'] = $nombreQ;
        $_SESSION['id'] = $idQ;
        $_SESSION['tipo'] = $tipoQ;
        $query->close();
        mysqli_close($conexion);
        header("location: entry.php");
    } else {
        $error = "No se ha encontrado ningún usuario con ese email o contraseña";
    }
}

if (isset($_POST['home'])) {
    header("location: ../index.php");
}
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-md w-75 p-3" id="loginContainer">
        <form action="login.php" method="post" id="loginform">
            <div class="mb-3">
                <label for="emailLogin" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="emailLogin" id="emailLogin" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="passLogin" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="passLogin" id="passLogin">
            </div>
            <button type="submit" name="loginbtn" class="btn btn-primary">Log In</button>
            <button type="submit" name="home" class="btn btn-primary">Volver</button>
        </form>
        <h4><?php echo $error ?></h4>
    </div>
</body>

</html>