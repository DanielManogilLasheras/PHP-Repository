<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: ../../index.php");
    exit();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../nav/nav.css" />
    <link rel="stylesheet" href="my-account.css" />
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg" id="nav-bar">
            <div class="container-fluid">
                <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start bg-secondary" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title justify-content-end" id="nav-bar-offcanvas-header">
                            SNOWBEAR PIRINEROS
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" id="nav-bard-offcanvas-body">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-md-3 justify-content-center align-items-center">
                                    <ul class="navbar-nav justify-content-between" id="nav-bar-page-links">
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
                                                <img src="../../resources/index-logo.png"
                                                    class="img-thumbnail bg-transparent border-0" alt="" />
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
                                        echo '<ul class="navbar-nav justify-content-between" id="nav-bar-page-links">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="backend/logout/logout.php">Cerrar sesión</a>
                                                </li>
                                            </ul>';
                                    } else {
                                        echo '<ul class="navbar-nav justify-content-between" id="nav-bar-page-links">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="frontend/register/register.php">Registrarse</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="frontend/login/login.php">Iniciar sesión</a>
                                                </li>
                                            </ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </nav>

        <div class="container" style="margin-top: 100px;">
            <?php
            //Se cargar las órdenes de compra que ha hecho el usuario logeado.
            include "../../db/db.php";
            $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
                or die("No se ha podido establecer conexión");

            $email = $_SESSION['email'];
            $stmt = mysqli_prepare($conexion, "SELECT * FROM orders WHERE client_email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-dark table-hover table-striped text-center align-middle">';
                echo '<thead class="table-warning">';
                echo '<tr>
                        <th>ID Orden</th>
                        <th>Fecha Orden</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Precio Total</th>
                        <th>Detalles</th>
                      </tr>';
                echo '</thead><tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['order_id'] . '</td>';
                    echo '<td>' . $row['date_order'] . '</td>';
                    echo '<td>' . $row['date_start'] . '</td>';
                    echo '<td>' . $row['date_end'] . '</td>';
                    echo '<td>' . number_format($row['price_total'], 2) . ' €</td>';
                    echo '<td><button class="btn btn-outline-warning btn-sm ver-detalles" data-order-id="' . $row['order_id'] . '">Ver</button></td>';
                    echo '</tr>';
                }

                echo '</tbody></table></div>';
            } else {
                echo "<p class='text-white'>No se encontraron órdenes.</p>";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
            ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const botonesDetalles = document.querySelectorAll('.ver-detalles');

            botonesDetalles.forEach(boton => {
                boton.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;

                    fetch('../../backend/get_order_details/get_order_details.php?id=' + orderId)
                        .then(response => response.json())
                        .then(data => {
                            let total = 0;
                            if (data.success) {
                                let contenido = '<ul style="text-align:left;">';
                                data.detalles.forEach(item => {
                                    total += item.price_unit;
                                    contenido += `<li><strong>${item.product_name}</strong> - ${item.quantity} uds x ${item.price_unit} €</li>`;
                                });
                                contenido += `<p style="text-align:center;">Total compra: ${total} €</p>`;
                                contenido += '</ul>';

                                Swal.fire({
                                    title: 'Detalles de la orden #' + orderId,
                                    html: contenido,
                                    icon: 'info',
                                    confirmButtonText: 'Cerrar',
                                    background: '#1c1c1c',
                                    color: 'white',
                                    confirmButtonColor: '#fbe839'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No se encontraron detalles para esta orden.',
                                    icon: 'error',
                                    background: '#1c1c1c',
                                    color: 'white',
                                    confirmButtonColor: '#fbe839'
                                });
                            }
                        });
                });
            });
        });
    </script>
</body>

</html>