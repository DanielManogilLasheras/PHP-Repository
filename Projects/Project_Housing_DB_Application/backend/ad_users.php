<?php
session_start();
$resultRegistro = "";
$error = "";
$found = false;
//Acción de volver a Home
if (isset($_POST['home'])) {
    header("location: ../frontend/entry.php");
}
//Acción de buscar usuario
if (isset($_POST['buscarbtn'])) {
    include "../db/db.php";
    $idUsuarioBuscar = htmlspecialchars($_POST['idUsuario']);
    //Establecer conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("No ha sido posible establecer conexión con la base de datos");
    //Preparar statement
    if ($query = $conexion->prepare("SELECT usuario_id,nombres,correo,tipo_usuario FROM usuario where usuario_id = ?")) {
        //VIncular parámetros
        $query->bind_param("i", $idUsuarioBuscar);
        //Ejecutar statement
        if ($query->execute()) {
            $query->store_result();
            //Prosigue si encuentras usuario
            if ($query->num_rows() > 0) {
                //Vinculamos los valores buscados con variables locales
                $query->bind_result($idResult, $nombreResult, $correoResult, $tipoResult);
                //Recoge los resultados de la query en las variables
                $query->fetch();
                $found = true;
                $query->close();
                $_SESSION['idUsuarioBuscado'] = $idResult;
                mysqli_close($conexion);
            } else {
                $error = "<h4 style='color:red'>No se ha encontrado usuario</h4>";
            }
        }
    }
}
//Acción de eliminar
if (isset($_POST['eliminarbtn'])) {
    include "../db/db.php";
    //Establecer conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db);
    //Preparar statement
    if ($query = $conexion->prepare("DELETE FROM usuario WHERE usuario_id = ?")) {
        //Vincular variables a parámetros de la query
        $query->bind_param("i", $_SESSION['idUsuarioBuscado']);
        //Ejecución de statement
        if ($query->execute()) {
            $resultRegistro = "<h4 style='color: green'>El Usuario se ha dado de baja con éxito</h4>";
            $query->close();
            mysqli_close($conexion);
        }
    }
}
//Acción de modificar usuario
if (isset($_POST['modificarbtn'])) {
    include "../db/db.php";
    $idUserMod = $_SESSION['idUsuarioBuscado'];
    $nombreUserMod = htmlspecialchars($_POST['nombre']);
    $correoUserMod = htmlspecialchars($_POST['email']);
    //Establecer conexión
    $conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db)
        or die("No se ha podido conectar con la base de datos");
    //Preparar statement
    if ($query = $conexion->prepare("UPDATE usuario SET nombres= ?, correo=? WHERE usuario_id = ?")) {
        //Vincular variables a parametros de la query
        $query->bind_param("ssi", $nombreUserMod, $correoUserMod, $idUserMod);
        //Ejecutar statement
        if ($query->execute()) {
            $resultRegistro = "<h4 style='color:green'>El Usuario ha sido actualizado correctamente</h4>";
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
        <form action="ad_users.php" method="post" id="buscarform">
            <div class="row flex">
                <div class="col-5 mb-3">
                    <label for="idUsuario" class="form-label">Id de Usuario:</label>
                    <input type="text" class="form-control" name="idUsuario" id="idUsuario" aria-describedby="idUsuario">
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
                    <p>Nombre: ' . $nombreResult . '</p>
                    <p>Correo: ' . $correoResult . '</p>
                    <p>Tipo de usuario: ' . $tipoResult . '</p>
                    <form action="ad_users.php" method="post" id="eliminarForm">
                        <button type="submit" name="eliminarbtn" class="btn btn-primary">Dar de baja</button>
                    </form>
                     
                </div>
                <div class="col-7">
                <h4>Introduce los datos a modificar</h4>
                            <form action="ad_users.php" method="post" id="modificarForm">
                            <div class="d-flex justify-content-start">
                                <label for="nombre" class="justify-content-end col-3 form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="calle" aria-describedby="nombre" value="' . $nombreResult . '">
                            </div>
                            <div class="d-flex justify-content-start">
                                <label for="email" class="col-3 form-label">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" aria-describedby="email" value="' . $correoResult . '">
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