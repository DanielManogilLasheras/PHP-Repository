<?php

$resultRegistro = "";
$error = "";
$found = false;
if (isset($_POST['home'])) {
    header("location: ../frontend/entry.php");
}
if (isset($_POST['buscarbtn'])) {
    include "../db/db.php";
    $idPisoBuscar = htmlspecialchars($_POST['idPiso']);
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("No ha sido posible establecer conexión con la base de datos");
    if ($query = $conexion->prepare("SELECT codigo_piso,calle,numero,piso,puerta,cp,metros,zona,precio FROM pisos where codigo_piso = ?")) {
        $query->bind_param("i", $idPisoBuscar);
        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows() > 0) {
                $query->bind_result($idResult, $calleResult, $numResult, $pisoResult, $puertaResult, $cpResult, $metrosResult, $zonaResult, $precioResult);
                $query->fetch();
                $found = true;
                echo $idResult, $calleResult, $numResult, $pisoResult, $puertaResult, $cpResult, $metrosResult, $zonaResult, $precioResult;
                $query->close();
            } else {
                $error = "<h4 style='color:red'>No se ha encontrado piso</h4>";
            }
        }
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
    <div class="container-md w-75 p-3" id="searchContainer">
        <form action="ad_flats.php" method="post" id="buscarform">
            <div class="row flex">
                <div class="col-5 mb-3">
                    <label for="idPiso" class="form-label">Id de Piso:</label>
                    <input type="text" class="form-control" name="idPiso" id="idPiso" aria-describedby="idPiso">
                </div>
            </div>
            <button type="submit" name="buscarbtn" class="btn btn-primary">Buscar piso</button>
            <button type="submit" name="home" class="btn btn-primary">Volver</button>
        </form>
        <p><?php echo $error ?></p>
    </div>
    <div class="container-md w-75 p-3" id="searchContainer">
        <?php
        if ($found) {
            echo "<h4>Id de Piso: " . $idResult . "</h4></h2>";
            echo ' 
            <div class="row">
                <div class="col-5 border-r-1">
                    <p>Calle: ' . $calleResult . '</p>
                    <p>Numero: ' . $numResult . '</p>
                    <p>Piso: ' . $pisoResult . '</p>
                    <p>Puerta: ' . $puertaResult . '</p>
                    <p>CP: ' . $cpResult . '</p>
                    <p>Metros ' . $metrosResult . '</p>
                    <p>Zona: ' . $zonaResult . '</p>
                    <p>Precio: ' . $precioResult . '</p>
                </div>
                <div class="col-5">
                            <form action="vender.php" method="post" id="venderform">
                            <div class="col-5 mb-3">
                            <div class="row">
                                <label for="calle" class="form-label">Calle:</label>
                                <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle">
                            </div>
                                
                            </div>
                            <div class="mb-3">
                            <div class="row">
                                <label for="numero" class="form-label">Número:</label>
                                <input type="text" class="form-control" name="numero" id="numero" aria-describedby="numero">
                            </div>

                            </div>
                            <div class="col-2 mb-3">
                            <div class="row">
                                <label for="piso" class="form-label">Piso:</label>
                                <input type="text" class="form-control" name="piso" id="piso" aria-describedby="piso">
                            </div>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="puerta" class="form-label">Puerta:</label>
                                <input type="text" class="form-control" name="puerta" id="puerta" aria-describedby="puerta">
                            </div>

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

                        <div class="col-2 mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="text" class="form-control" name="precio" id="precio" aria-describedby="precio">
                        </div>
                        <button type="submit" name="sellbtn" class="btn btn-primary">Dar de alta</button>
                        <button type="submit" name="home" class="btn btn-primary">Volver</button>
                    </form>
                </div>
            </div>
            
            ';
        }
        ?>
    </div>
    <?php

    ?>
</body>

</html>