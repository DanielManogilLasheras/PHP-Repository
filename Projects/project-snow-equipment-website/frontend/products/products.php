<?php
include "../../db/db.php";
session_start();
$conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db);
$productos = [];
//Buscamos toods los productos en la tabla para mostrarlos.
if ($conexion) {
  $query = "SELECT name, price, available, categoria FROM products ORDER BY categoria, name";
  $resultado = mysqli_query($conexion, $query);

  while ($fila = mysqli_fetch_assoc($resultado)) {
    $productos[$fila['categoria']][] = $fila;
  }

  mysqli_close($conexion);
}

if (isset($_POST['submit'])) {
  $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db); // Necesitas volver a abrir conexión

  if (!$conexion) {
    $_SESSION['swal'] = [
      'title' => 'Error',
      'text' => 'Error al conectar a la base de datos',
      'icon' => 'error'
    ];
    header("Location: products.php");
    exit;
  }
  //Validación: Debe haber un usuario logeado para realizar un pedido.
  if (!isset($_SESSION['loggedin'])) {
    $_SESSION['swal'] = [
      'title' => 'Error',
      'text' => 'Debes iniciar sesión para tramitar un pedido',
      'icon' => 'error'
    ];
    header("Location: products.php");
    exit;
  }

  // Validación de fechas
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $fecha_hoy = date('Y-m-d');
  $fecha_mañana = date('Y-m-d', strtotime('+1 day'));

  if ($fecha_inicio < $fecha_mañana) {
    $_SESSION['swal'] = [
      'title' => 'Error',
      'text' => 'La fecha de inicio no puede ser anterior a mañana',
      'icon' => 'error'
    ];
    header("Location: products.php");
    exit;
  }

  // Validar cantidad de productos
  $cantidad_total = 0;
  $productos_seleccionados = [];

  foreach ($_POST['cantidad'] as $nombre_producto => $cantidad) {
    if ($cantidad > 0) {
      $productos_seleccionados[] = $nombre_producto;
      $cantidad_total += $cantidad;
      if ($cantidad > 5) {
        $_SESSION['swal'] = [
          'title' => 'Error',
          'text' => 'No puedes pedir más de 5 unidades de un producto',
          'icon' => 'error'
        ];
        header("Location: products.php");
        exit;
      }
    }
  }

  if ($cantidad_total == 0) {
    $_SESSION['swal'] = [
      'title' => 'Error',
      'text' => 'No hay productos pendientes en tu pedido',
      'icon' => 'error'
    ];
    header("Location: products.php");
    exit;
  }

  // Calcular el precio total
  $precio_total = 0;
  foreach ($productos_seleccionados as $nombre_producto) {
    $query_producto = "SELECT price FROM products WHERE name = '$nombre_producto'";
    $resultado_producto = mysqli_query($conexion, $query_producto);
    $producto = mysqli_fetch_assoc($resultado_producto);

    $precio_unitario = $producto['price'];
    $cantidad = $_POST['cantidad'][$nombre_producto];
    $dias_alquiler = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24);
    $precio_total += $precio_unitario * $cantidad * $dias_alquiler * 1.20;
  }

  // Insertar orden
  $email_cliente = $_SESSION['email'];
  $query_insertar_orden = "INSERT INTO orders (client_email, date_order, date_start, date_end, price_total) 
                         VALUES ('$email_cliente', NOW(), '$fecha_inicio', '$fecha_fin', '$precio_total')";
  mysqli_query($conexion, $query_insertar_orden);

  $order_id = mysqli_insert_id($conexion);

  // Insertar detalles
  foreach ($productos_seleccionados as $nombre_producto) {
    $cantidad = $_POST['cantidad'][$nombre_producto];
    $query_producto = "SELECT price FROM products WHERE name = '$nombre_producto'";
    $resultado_producto = mysqli_query($conexion, $query_producto);
    $producto = mysqli_fetch_assoc($resultado_producto);
    $precio_unitario = $producto['price'] * 1.20;

    $query_insertar_detalle = "INSERT INTO order_details (id_order, product_name, quantity, price_unit) 
                               VALUES ($order_id, '$nombre_producto', $cantidad, $precio_unitario)";
    mysqli_query($conexion, $query_insertar_detalle);
  }

  mysqli_close($conexion);

  $_SESSION['swal'] = [
    'title' => '¡Éxito!',
    'text' => 'La reserva ha sido completada con éxito, te estaremos esperando!',
    'icon' => 'success'
  ];

  header("Location: products.php");
  exit;
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../nav/nav.css" />
  <link rel="stylesheet" href="products.css">
  <title>Snowbear - Contact Us</title>
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
                  <?php
                  if (isset($_SESSION['loggedin'])) {
                    echo '<ul
                                        class="navbar-nav justify-content-between"
                                        id="nav-bar-page-links">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../my-account/my-account.php">Mi cuenta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../../backend/logout/logout.php">Cerrar sesión</a>
                                        </li>

                                        </ul> ';
                  } else {
                    echo '<ul
                                        class="navbar-nav justify-content-between"
                                        id="nav-bar-page-links">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="../register/register.php">Registrarse</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../login/login.php">Iniciar sesión</a>
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
    <div class="container">
      <form action="products.php" method="post" class="container mt-5">
        <!-- Campos de fecha para seleccionar el inicio y fin del alquiler -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="fecha_inicio" style="color: #fbe839;">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="fecha_fin" style="color: #fbe839;">Fecha de fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
          </div>
        </div>

        <!-- Productos del formulario -->
        <?php foreach ($productos as $categoria => $items): ?>
          <div class="card mb-4">
            <div class="card-header bg-primary text-white">
              <strong><?= htmlspecialchars($categoria) ?></strong>
            </div>
            <div class="card-body">
              <?php foreach ($items as $producto): ?>
                <div class="row mb-3 align-items-center">
                  <div class="col-md-5"><?= htmlspecialchars($producto['name']) ?></div>
                  <div class="col-md-2"><?= $producto['price'] ?> €</div>
                  <div class="col-md-3">
                    <label for="cantidad_<?= htmlspecialchars($producto['name']) ?>" style="color: #fbe839;">Cantidad</label>
                    <input type="number" min="0" max="<?= $producto['available'] ?>"
                      name="cantidad[<?= htmlspecialchars($producto['name']) ?>]"
                      id="cantidad_<?= htmlspecialchars($producto['name']) ?>"
                      class="form-control" placeholder="Cantidad">
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>

        <button type="submit" name="submit" class="btn btn-success">Enviar pedido</button>
      </form>
    </div>
  </div>
  <?php if (isset($_SESSION['swal'])): ?>
    <script>
      Swal.fire({
        title: "<?= $_SESSION['swal']['title'] ?>",
        text: "<?= $_SESSION['swal']['text'] ?>",
        icon: "<?= $_SESSION['swal']['icon'] ?>"
      });
    </script>
    <?php unset($_SESSION['swal']); ?>
  <?php endif; ?>
</body>

</html>