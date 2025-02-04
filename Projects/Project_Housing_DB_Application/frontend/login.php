usuario_id, nombres, correo, clave, tipo_usuario
<?php
$error = "";
if (isset($_POST['loginbtn'])) {
    $email = $_POST['emailLogin'];
    $password = $_POST['passLogin'];
    $conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
        or die("Error en la conexión con la base de datos");
    $statement = "SELECT * FROM usuario WHERE usuario.correo = '$email' AND usuario.clave = '$password'";
    if ($result = mysqli_query($conexion, $statement)) {
        $numrows = mysqli_num_rows($result);
        if ($numrows > 0) {
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['activeSession'] = true;
            $_SESSION['username'] = $row['nombres'];
            $_SESSION['userEmail'] = $row['correo'];
            $_SESSION['userId'] = $row['id_usuario'];
            mysqli_close($conexion);
            header("location: ../index.php");
        } else {
            $error = "No se ha encontrado ningún usuario con ese email o contraseña";
        }
    } else {
        $error = "Error en base de datos, inténtelo más tarde.";
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
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck">
                <label class="form-check-label" for="exampleCheck1">Recordar usuario</label>
            </div>
            <button type="submit" name="loginbtn" class="btn btn-primary">Log In</button>
            <button type="submit" name="home" class="btn btn-primary">Volver</button>
        </form>
        <h4><?php echo $error ?></h4>
    </div>
</body>

</html>