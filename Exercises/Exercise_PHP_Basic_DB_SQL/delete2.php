<?php
session_start();
$_SESSION['result'] = "";
$idCar = $_SESSION['id'];
$connection  = mysqli_connect("localhost", "root", "", "concesionario");
$query = "DELETE FROM coches WHERE coches.id = ('$idCar');";
if (mysqli_query($connection, $query)) {
    $_SESSION['result'] = "El coche se ha eliminado correctamente";
} else {
    $_SESSION['result']  = "Error" . $query . "<br>" . mysqli_error($conection);
}
header("location: index.php");
exit;
