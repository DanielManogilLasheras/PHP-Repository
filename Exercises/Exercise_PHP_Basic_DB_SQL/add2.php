<?php

session_start();
$id = "";
$brand = $_SESSION['brand'];
$model = $_SESSION['model'];
$year = $_SESSION['year'];
$_SESSION['result'] = "";
$conection = mysqli_connect("localhost", "root", "", "concesionario")
    or die("Connection to the host could not be stablished");
$query = "INSERT INTO coches (id,marca,modelo,año) VALUES ('$id','$brand','$model','$year');";
if (mysqli_query($conection, $query)) {
    $_SESSION['result']  = "producto añadido correctamente";
} else {
    $_SESSION['result']  = "Error" . $query . "<br>" . mysqli_error($conection);
}
header("location: index.php");
exit;
