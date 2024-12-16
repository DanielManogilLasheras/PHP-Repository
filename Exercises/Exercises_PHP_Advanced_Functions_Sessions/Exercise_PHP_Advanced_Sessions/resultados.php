<?php
session_start();
$error1 = '';
$error2 = '';
$error3 = '';
if (!isset($_SESSION['nombre']) OR !isset($_SESSION['apellidos'])){
    $error1 = '<p>Debes insertar nombre y apellidos</p>';
    echo $error1;
}else{
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
    if($nombre == ''){
        $error2+= '<p>No hay nombre registrado </p>';
        echo $error2;
    }else{
        echo "<p>Nombre: " .$nombre. "</p>";
    }
    if($apellidos == ''){
        $error3 += '<p>No hay apellido registrado</p>';
        echo $error3;
    }else{
        echo "<p>Apellidos: " .$apellidos. "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
            <p><a href="index.php">Home</a></p>
    </body>
</html>