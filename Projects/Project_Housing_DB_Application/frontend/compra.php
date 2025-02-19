<?php
include("../db/db.php");
$resultRegistro = "";
//Guardamos el valor introducido por la carta del producto, que es el id
$idBuy = $_POST['idBuy'];
$comprado = 1;
//Conectar con base de datos
$conexion = mysqli_connect($host, $userAdmin, $passAdmin, $db);
//Preparar statement
if ($query = $conexion->prepare("SELECT precio FROM pisos WHERE codigo_piso=?")) {
    $query->bind_param("i", $idBuy);
    if ($query->execute()) {
        //Guardar los resultados en variables
        $query->store_result();
        $query->bind_result($precioPiso);
        //Calcular precio final
        $preciofinal = ($precioPiso * 0.25) + $precioPiso;
    }
}
//Preparamos statement para poner el piso como comprado y que no aparezca en los pisos disponibles
if ($query  = $conexion->prepare("UPDATE pisos SET comprado=? WHERE codigo_piso=?")) {
    $query->bind_param("is", $comprado, $idBuy);
    //Ejecución de statement
    if ($query->execute()) {
        $query->close();
        //Se prepara statement para guardar el piso en la tabla de comprados.
        if ($query = $conexion->prepare("INSERT INTO comprados (usuario_comprador,codigo_piso,Precio_final) VALUES (?,?,?)  ")) {
            session_start();
            $query->bind_param("iii", $_SESSION['id'], $idBuy, $preciofinal);
            if ($query->execute()) {
                $resultRegistro = '<div class="alert alert-success" role="alert">
                Compra completada, puede  volver a<a href="login.php" class="alert-link">Inicio</a>.
                </div>';
                $query->close();
                mysqli_close($conexion);
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
</body>

</html>