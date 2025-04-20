<?php
session_start();
$error = "";
define('USER_FILE', '../../file/users.txt');

// Comprobación de que si el usuario ya ha iniciado sesión, se le redirige al index
if (isset($_SESSION['loggedin'])) {
    header("Location: ../../index.php");
    exit();
}

// Acción de login
if (isset($_POST['loginbtn'])) {
    $email = htmlspecialchars($_POST['emailLogin']);
    $password = htmlspecialchars($_POST['passLogin']);

    if ($email === "" || $password === "") {
        $error = "Faltan datos de usuario";
    } else {
        $fp = fopen(USER_FILE, 'r');
        if (!$fp) {
            $error = "No se pudo abrir el archivo de usuarios.";
        } else {
            $usuarioEncontrado = false;
            while (($line = fgets($fp)) !== false) {
                $line = trim($line);
                if ($line === '') continue;

                list($correoGuardado, $passF) = explode(':', $line, 2);
                if (trim($correoGuardado) === trim($email)) {
                    $usuarioEncontrado = true;

                    if (password_verify($password, trim($passF))) {
                        session_regenerate_id();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        fclose($fp);
                        header("Location: ../../index.php");
                        exit();
                    } else {
                        $error = "La contraseña es incorrecta";
                        break;
                    }
                }
            }
            fclose($fp);

            if (!$usuarioEncontrado) {
                $error = "El usuario no existe";
            }
        }
    }
}

// Redirigir a home
if (isset($_POST['home'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="login.css">
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
                                <div class="col-md-3 d-flex justify-content-center">
                                    <ul
                                        class="navbar-nav justify-content-end flex-grow-4"
                                        id="nav-bar-social-link">
                                        <li>

                                        </li>
                                        <li>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </nav>
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
    </div>

</body>

</html>