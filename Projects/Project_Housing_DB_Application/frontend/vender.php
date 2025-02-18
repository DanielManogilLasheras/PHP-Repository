<?php
$resultRegistro = "";
$error = "";
if (isset($_POST['home'])) {
    header("location: entry.php");
}
if (isset($_POST['sellbtn'])) {
    session_start();
    $continue = true;
    $usuario_id = $_SESSION['id'];
    $calle = htmlspecialchars($_POST['calle']);
    $numero = htmlspecialchars($_POST['numero']);
    $piso = htmlspecialchars($_POST['piso']);
    $puerta = htmlspecialchars($_POST['puerta']);
    $cp = htmlspecialchars($_POST['cp']);
    $metros = htmlspecialchars($_POST['metros']);
    $zona = htmlspecialchars($_POST['zona']);
    $precio = htmlspecialchars($_POST['precio']);
    $arrayvalores = array($calle, $numero, $piso, $puerta, $cp, $metros, $zona, $precio);
    foreach ($arrayvalores as $element) {
        if ($element == "") {
            $error = "<h4 style='color:red'>Faltan campos por rellenar</h4>";
            $continue = false;
        }
    }
    if ($continue) {
        include "../db/db.php";
        $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
            or die("No se ha podido establecer conexión con la base de datos");
        if ($query = $conexion->prepare("INSERT INTO pisos (calle,numero,piso,puerta,cp,metros,zona,precio,piso_usuario_id) VALUES (?,?,?,?,?,?,?,?,?)")) {
            $query->bind_param("sissiisii", $calle, $numero, $piso, $puerta, $cp, $metros, $zona, $precio, $usuario_id);
            if ($query->execute()) {
                $resultRegistro = '<div class="alert alert-success" role="alert">
                Ha añadido el piso con éxito..
                </div>';
                $query->close();
            } else {
                $resultRegistro = '<div class="alert alert-success" role="alert">
                Se ha equivocado en los datos introducidos.
                </div>';
            }
        }
        mysqli_close($conexion);
    }
}
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <p><?php echo $resultRegistro ?></p>
    <div class="container-md w-75 p-3" id="venderContainer">
        <form action="vender.php" method="post" id="venderform">
            <div class="row flex">
                <div class="col-5 mb-3">
                    <label for="calle" class="form-label">Calle:</label>
                    <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle">
                </div>
                <div class="col-3 mb-3">
                    <label for="numero" class="form-label">Número:</label>
                    <input type="text" class="form-control" name="numero" id="numero" aria-describedby="numero">
                </div>
                <div class="col-2 mb-3">
                    <label for="piso" class="form-label">Piso:</label>
                    <input type="text" class="form-control" name="piso" id="piso" aria-describedby="piso">
                </div>
                <div class="col-2 mb-3">
                    <label for="puerta" class="form-label">Puerta:</label>
                    <input type="text" class="form-control" name="puerta" id="puerta" aria-describedby="puerta">
                </div>
            </div>
            <div class="row">
                <div class="col-2 mb-3">
                    <label for="cp" class="form-label">Código postal:</label>
                    <input type="text" class="form-control" name="cp" id="cp" aria-describedby="cp">
                </div>
                <div class="col-2 mb-3">
                    <label for="metros" class="form-label">Metros cuadrados:</label>
                    <input type="text" class="form-control" name="metros" id="metros" aria-describedby="metros">
                </div>
                <div class="col-2 mb-3">
                    <label for="zona" class="form-label">Zona:</label>
                    <input type="text" class="form-control" name="zona" id="zona" aria-describedby="zona">
                </div>
            </div>
            <div class="col-2 mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" name="precio" id="precio" aria-describedby="precio">
            </div>
            <button type="submit" name="sellbtn" class="btn btn-primary">Dar de alta</button>
            <button type="submit" name="home" class="btn btn-primary">Volver</button>
        </form>
        <p><?php echo $error ?></p>
    </div>
</body>

</html>