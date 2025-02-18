<?php
function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}
function validatePassword($pass)
{
    return true;
    $rejex = preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{,7}$/', $pass);
    if (!$rejex) {
        return false;
    }
    return true;
}
$error = array("", "", "", "", "", "");
$resultRegistro = "";
if (isset($_POST['home'])) {
    header("location: ../index.php");
}
if (isset($_POST['registro'])) {
    $validated = true;
    $nombre = htmlspecialchars($_POST['nombreRegistro']);
    $apellidos = htmlspecialchars($_POST['apellidosRegistro']);
    $email = htmlspecialchars($_POST['emailRegistro']);
    $password = htmlspecialchars($_POST['passRegistro']);
    $confpassword = htmlspecialchars($_POST['confpassRegistro']);
    $tipoUsuario = htmlspecialchars($_POST['tipoUserRegistro']);

    if ($nombre == "") {
        $error[0] = "Hace falta un nombre";
        $validated = false;
    }
    if ($apellidos == "") {
        $error[1] = "Hacen falta apellidos";
        $validated = false;
    }
    if ($email == "") {
        $error[2] = "Hace falta un correo";
        $validated = false;
    } else if (!validateEmail($email)) {
        $error[2] = "Escriba una dirección de correo válida";
        $validated = false;
    }
    if ($password == "") {
        $error[3] = "Hace falta una contraseña";
        $validated = false;
    } else if (!validatePassword($password)) {
        $error[3] = "La contraseña debe: Ser de 8 caracteres mínimo, incluir 1 mayúscula, 1 minúscula y 1 número";
        $validated = false;
    }
    if ($confpassword == "") {
        $error[4] = "Confirme contraseña";
        $validated = false;
    } else if ($password != $confpassword) {
        $error[4] == "Las contraseñas no coinciden";
        $validated = false;
    }
    if ($tipoUsuario == 0) {
        $error[5] = "Falta tipo de usuario";
        $validated = false;
    }
    if ($validated) {
        $connection = mysqli_connect("localhost", "root", "", "inmobiliaria")
            or die("Error al establecer conexión con la base de datos");
        if ($query = $connection->prepare("SELECT * FROM usuario WHERE correo = ?")) {
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            $result = $query->affected_rows;
            $query->close();
        }
        if ($result >= 1) {
            $resultRegistro = '<div class="alert alert-danger" role="alert">La dirección de correo coincide con una cuenta creada.</div>';
        } else {
            $nombreCompleto = $nombre . " " . $apellidos;
            $password = password_hash($password, PASSWORD_DEFAULT);
            if ($query = $connection->prepare("INSERT INTO usuario (nombres,correo,clave,tipo_usuario) VALUES (?,?,?,?)")) {
                $query->bind_param("sssi", $nombreCompleto, $email, $password, $tipoUsuario);
                if ($query->execute()) {
                    $resultRegistro = '<div class="alert alert-success" role="alert">
                    Registro completado, puede  <a href="login.php" class="alert-link">iniciar sesión</a>.
                    </div>';
                    $query->close();
                }
            }
        }
    }
    mysqli_close($connection);
}
?>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-md w-75 p-3" id="loginContainer">
        <p><?php echo $resultRegistro ?></p>
        <form action="registro.php" method="post" id="registroForm">
            <div class="mb-3">
                <label for="nombre" class="form-label"><?php echo "Nombre:* " . $error[0] ?></label>
                <input type="text" class="form-control" name="nombreRegistro" id="nombreRegistro" aria-describedby="nombre">

            </div>
            <div class="mb-3">
                <label for="apellidosRegistro" class="form-label"><?php echo "Apellidos:* " . $error[1] ?></label>
                <input type="text" class="form-control" name="apellidosRegistro" id="apellidosRegistro" aria-describedby="apellidos">
            </div>
            <div class="mb-3">
                <label for="emailRegistro" class="form-label"><?php echo "Correo:* " . $error[2] ?></label>
                <input type="email" class="form-control" name="emailRegistro" id="emailRegistro" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="passRegistro" class="form-label"><?php echo "Contraseña:* " . $error[3] ?></label>
                <input type="password" class="form-control" name="passRegistro" id="passRegistro" aria-describedby="password">
            </div>
            <div class="mb-3">
                <label for="confpassRegistro" class="form-label"><?php echo "Confirmar contraseña:* " . $error[4] ?></label>
                <input type="password" class="form-control" name="confpassRegistro" id="confpassRegistro" aria-describedby="confirm password">
            </div>
            <select class="form-select" name="tipoUserRegistro" aria-label="Default select example">
                <option value="0" selected>Tipo de usuario</option>
                <option value="1">Comprador</option>
                <option value="2">Vendedor</option>
            </select>
            <div id="error"><?php echo $error[5] ?></div>
            <div class="mb-3">
                <button type="submit" name="registro" class="btn btn-primary">Registrarse</button>
                <button type="submit" name="home" class="btn btn-primary">Volver</button>
            </div>
        </form>
    </div>
</body>

</html>