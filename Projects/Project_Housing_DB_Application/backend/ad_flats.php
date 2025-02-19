<?php
session_start();
//Iniciar variables que usaremos
$resultRegistro = "";
$error = "";
$found = false;
//Acción de ir a home
if (isset($_POST['home'])) {
    header("location: ../frontend/entry.php");
}
//Acción de buscar el piso
if (isset($_POST['buscarbtn'])) {
    include "../db/db.php";
    //Evitar inyección SQL
    $idPisoBuscar = htmlspecialchars($_POST['idPiso']);
    //Establecemos conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("No ha sido posible establecer conexión con la base de datos");
    //Preparamos statement
    if ($query = $conexion->prepare("SELECT codigo_piso,calle,numero,piso,puerta,cp,metros,zona,precio FROM pisos where codigo_piso = ?")) {
        $query->bind_param("i", $idPisoBuscar);
        //Ejecución de statement
        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows() > 0) {
                //Guardamos valores en variables
                $query->bind_result($idResult, $calleResult, $numResult, $pisoResult, $puertaResult, $cpResult, $metrosResult, $zonaResult, $precioResult);
                $query->fetch();
                //Cambiamos el booleano a true para permitir la ejecución del html para mostrar el user
                $found = true;
                echo $idResult, $calleResult, $numResult, $pisoResult, $puertaResult, $cpResult, $metrosResult, $zonaResult, $precioResult;
                $query->close();
                mysqli_close($conexion);
                $_SESSION['idPiso'] = $idResult;
            } else {
                $error = "<h4 style='color:red'>No se ha encontrado piso</h4>";
            }
        }
    }
}
//Acción de elmininar
if (isset($_POST['eliminarbtn'])) {
    include "../db/db.php";
    //Establecemos conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db);
    //Preparamos statement
    if ($query = $conexion->prepare("DELETE FROM pisos WHERE codigo_piso = ?")) {
        $query->bind_param("i", $_SESSION['idPiso']);
        if ($query->execute()) {
            //Exito en el borrado
            $resultRegistro = "<h4 style='color: green'>El piso se ha dado de baja con éxito</h4>";
            $query->close();
            mysqli_close($conexion);
        }
    }
}
//Acción de modificar piso
if (isset($_POST['modificarbtn'])) {
    include "../db/db.php";
    //Guardamos variables y aplicamos medidas contra SQL injection o inyección de scripts
    $idPisoMod = $_SESSION['idPiso'];
    $callePisoMod = htmlspecialchars($_POST['calle']);
    $numeroPisoMod = htmlspecialchars($_POST['numero']);
    $pisoPisoMod = htmlspecialchars($_POST['piso']);
    $puertaPisoMod = htmlspecialchars($_POST['puerta']);
    $cpPisoMod = htmlspecialchars($_POST['cp']);
    $metrosPisoMod = htmlspecialchars($_POST['metros']);
    $zonaPisoMod = htmlspecialchars($_POST['zona']);
    $precioPisoMod = htmlspecialchars($_POST['precio']);
    //Establecemos conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("No se ha podido conectar con la base de datos");
    //Preparamos statement
    if ($query = $conexion->prepare("UPDATE pisos SET calle= ?, numero=?,piso=?,puerta=?,cp=?,metros=?,zona=?,precio=? WHERE codigo_piso = ?")) {
        //Vinculamos las variables, esto es una medida de seguridad y facilita las consultas.
        $query->bind_param("siisiiiii", $callePisoMod, $numeroPisoMod, $pisoPisoMod, $puertaPisoMod, $cpPisoMod, $metrosPisoMod, $zonaPisoMod, $precioPisoMod, $idPisoMod);
        //Ejecución de statement
        if ($query->execute()) {
            $resultRegistro = "<h4 style='color:green'>El piso ha sido actualizado correctamente</h4>";
            $query->close();
            mysqli_close($conexion);
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
            echo ' 
            <div class="row">
                <div class="col-3 border-r-1">
                <h4>Id de piso: ' . $idResult . '</h4>
                    <p>Calle: ' . $calleResult . '</p>
                    <p>Numero: ' . $numResult . '</p>
                    <p>Piso: ' . $pisoResult . '</p>
                    <p>Puerta: ' . $puertaResult . '</p>
                    <p>CP: ' . $cpResult . '</p>
                    <p>Metros ' . $metrosResult . '</p>
                    <p>Zona: ' . $zonaResult . '</p>
                    <p>Precio: ' . $precioResult . '</p>
                    <form action="ad_flats.php" method="post" id="eliminarForm">
                        <button type="submit" name="eliminarbtn" class="btn btn-primary">Dar de baja</button>
                    </form>
                     
                </div>
                <div class="col-7">
                <h4>Introduce los datos a modificar</h4>
                            <form action="ad_flats.php" method="post" id="modificarForm">
                            <div class="d-flex justify-content-start">
                                <label for="calle" class="justify-content-end col-3 form-label">Calle:</label>
                                <input type="text" class="form-control" name="calle" id="calle" aria-describedby="calle" value="' . $calleResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="numero" class="col-3 form-label">Número:</label>
                                <input type="text" class="form-control" name="numero" id="numero" aria-describedby="numero" value="' . $numResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="piso" class="col-3 form-label">Piso:</label>
                                <input type="text" class="form-control" name="piso" id="piso" aria-describedby="piso" value="' . $pisoResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="puerta" class="col-3 form-label">Puerta:</label>
                                <input type="text" class="form-control" name="puerta" id="puerta" aria-describedby="puerta" value="' . $puertaResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="cp" class="col-3 form-label">Código postal:</label>
                                <input type="text" class="form-control" name="cp" id="cp" aria-describedby="cp" value="' . $cpResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="metros" class="col-3 form-label">Metros cuadrados:</label>
                                <input type="text" class="form-control" name="metros" id="metros" aria-describedby="metros" value="' . $metrosResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="zona" class="col-3 form-label">Zona:</label>
                                <input type="text" class="form-control" name="zona" id="zona" aria-describedby="zona" value="' . $zonaResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="precio" class="col-3 form-label">Precio:</label>
                                <input type="text" class="form-control" name="precio" id="precio" aria-describedby="precio" value="' . $precioResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                            <button type="submit" name="modificarbtn" class="btn btn-primary">Aplicar cambios</button>  
                            </div>
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