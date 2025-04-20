<?php
//Una función para validar email
function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}
//Una función para validar contraseña con REJEX
function validatePassword($pass)
{
    $rejex = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass);
    if (!$rejex) {
        return true;
    }
    return true;
}
function comparePasswords($pass, $confpass)
{
    if ($pass === $confpass) {
        return true;
    } else {
        return false;
    }
}
define('USER_FILE', '../../file/users.txt');

function usuarioExiste($email)
{
    if (!file_exists(USER_FILE)) return false;

    $fp = fopen(USER_FILE, 'r');
    if (!$fp) return false;

    while (($line = fgets($fp)) !== false) {
        $line = trim($line);
        if ($line === '') continue;

        list($correoGuardado,) = explode(':', $line, 2);
        if (trim($correoGuardado) === trim($email)) {
            fclose($fp);
            return true;
        }
    }

    fclose($fp);
    return false;
}


//Los errores se guardan en un array, que seran lanzados en el formulario, cada posición en su respectivo campo
$error = array("", "", "", "", "", "");
$resultRegistro = "";
//Acción de ir al index
if (isset($_POST['home'])) {
    header("location: ../../index.php");
}
if (isset($_POST['registro'])) {
    $validated = true;
    //Guardamos valores de formulario en variables y aplicamos medidas contra SQL injection
    $email = htmlspecialchars($_POST['emailRegistro']);
    $password = htmlspecialchars($_POST['passRegistro']);
    $confpass = htmlspecialchars($_POST['confpassRegistro']);
    //Validamos que todos los campos estén llenos y cumplan con los parámetros.
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
    if ($confpass == "") {
        $error[4] = "Confirme contraseña";
        $validated = false;
    } else if (!comparePasswords($password, $confpass)) {
        $error[4] = "Las contraseñas no coinciden";
        $validated = false;
    }
    if ($validated) {
        //COMPROBAR CON FICHERO DE USUARIOS
        if (usuarioExiste($email)) {
            $error[5] = "El correo asociado a este usuario ya existe";
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $linea = "$email:$hash" . PHP_EOL;

        $fp = fopen(USER_FILE, 'a');
        if (!$fp) $error[5] = "No se pudo abrir el archivo de texto";

        fwrite($fp, $linea);
        fclose($fp);

        echo "<script>alert('Usuario registrado con éxito');</script>";
    }
}
?>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg" id="nav-bar">
            <div class="container-fluid">
                <button
                    class="navbar-toggler bg-secondary"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="offcanvas offcanvas-start bg-secondary"
                    tabindex="-1"
                    id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5
                            class="offcanvas-title justify-content-end"
                            id="nav-bar-offcanvas-header">
                            SNOWBEAR PIRINEROS
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" id="nav-bard-offcanvas-body">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-md-3 justify-content-center align-items-center">
                                    <ul
                                        class="navbar-nav justify-content-between"
                                        id="nav-bar-page-links">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../products/products.php">Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../contact-us/contact-us.php">Contacto</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="container text-center" id="nav-bar-logo">
                                        <div class="row g-0 align-items-center">
                                            <div class="col">
                                                <h3 class="h3">SNOWBEAR</h3>
                                            </div>
                                            <div class="col">
                                                <img
                                                    src="../../resources/index-logo.png"
                                                    class="img-thumbnail bg-transparent border-0"
                                                    alt="" />
                                            </div>
                                            <div class="col">
                                                <h3 class="h3">PIRINEOS</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </nav>
        <div class="container-md w-75 p-3" id="loginContainer">
            <p><?php echo $resultRegistro ?></p>
            <form action="register.php" method="post" id="registroForm">
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
                <div id="error"><?php echo $error[5] ?></div>
                <div class="mb-3">
                    <button type="submit" name="registro" class="btn btn-primary">Registrarse</button>
                    <button type="submit" name="home" class="btn btn-primary">Volver</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>