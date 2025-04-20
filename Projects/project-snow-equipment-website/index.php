<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="frontend/nav/nav.css" />
    <link rel="stylesheet" href="index.css" />
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
                                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="frontend/products/products.php">Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="frontend/contact-us/contact-us.php">Contacto</a>
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
                                                    src="resources/index-logo.png"
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
                                    <?php
                                    if (isset($_SESSION['loggedin'])) {
                                        echo '<ul
                                        class="navbar-nav justify-content-between"
                                        id="nav-bar-page-links">
                                        <li class="nav-item">
                                            <a class="nav-link" href="frontend/my-account/my-account.php">Mi cuenta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="backend/logout/logout.php">Cerrar sesión</a>
                                        </li>

                                        </ul> ';
                                    } else {
                                        echo '<ul
                                        class="navbar-nav justify-content-between"
                                        id="nav-bar-page-links">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="frontend/register/register.php">Registrarse</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="frontend/login/login.php">Iniciar sesión</a>
                                        </li>

                                        </ul> ';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </nav>
        <div class="row" id="content-phrase">
            <div class="column-lg-12">
                <h2 class="h2 align-content-center align-items-center">Lleva los Pirineos al límite</h2>
            </div>
        </div>
        <div class="row justify-content-center" id="content-cards">
            <div class="card bg-transparent" style="width: 30rem;">
                <div class="cad-body">
                    <h5 class="card-title">Alquiler de vehículos de nieve</h5>
                </div>
                <img src="resources/index-img-two.png" class="card-img-top" alt="...">
                <div class="card-body">

                    <p class="card-text">Excursiones en ATV a los lugares más bonitos de los Pirineos</p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success"><a href="frontend/contact-us/contact-us.php" class="card-link">Explora</a></button>

                </div>
            </div>
            <div class="card bg-transparent" style="width: 30rem;">
                <div class="cad-body">
                    <h5 class="card-title">Alquiler de esquís / Tablas de Snowboard</h5>
                </div>
                <img src="resources/index-image-four.jpg" class="card-img-top" alt="...">
                <div class="card-body">

                    <p class="card-text">Alquiler de esquís y tablas para toda la familia</p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success"><a href="frontend/products/products.php" class="card-link">Escoge</a></button>
                </div>
            </div>
            <div class="card bg-transparent" style="width: 30rem;">
                <div class="cad-body">
                    <h5 class="card-title">Alquiler de ropa de nieve</h5>
                </div>
                <img src="resources/index-image-five.png" class="card-img-top" alt="...">
                <div class="card-body">

                    <p class="card-text">Todo el equipo que necesitas para niños y adultos</p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success"><a href="frontend/products/products.php" class="card-link">Equípate</a></button>
                </div>
            </div>
            <div class="card bg-transparent" style="width: 30rem;">
                <div class="cad-body">
                    <h5 class="card-title">¿Alguna duda?</h5>
                </div>
                <img src="resources/index-image-five.png" class="card-img-top" alt="...">
                <div class="card-body">

                    <p class="card-text">¿Necesitas ayuda? Ponte en contacto</p>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success"><a href="frontend/contact-us/contact-us.php" class="card-link">Te ayudaremos</a></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>