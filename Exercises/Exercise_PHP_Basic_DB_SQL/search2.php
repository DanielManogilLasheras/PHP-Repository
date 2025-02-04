<?php
session_start();
$_SESSION['result'] = "";
$idCar = $_SESSION['idSearch'];
$connection  = mysqli_connect("localhost", "root", "", "concesionario");
$query = "SELECT * FROM coches WHERE coches.id = ('$idCar');";
if ($result = mysqli_query($connection, $query)) {
    $nrows  = mysqli_num_rows($result);
    if ($nrows > 0) {
        $row = mysqli_fetch_assoc($result);
    }
} else {
    $_SESSION['result']  = "Error" . $query . "<br>" . mysqli_error($conection);
}
?>
<html>

<head>

</head>

<body>
    <form action="index.php" method="post">
        <input type="submit" name="home" value="Home">
    </form>
    <h2>RESULTADOS DE BUSQUEDA:</h2>
    <?php echo "ID: " . $row["id"] . "|  MARCA: " . $row["marca"] . "| MODELO:  " . $row["modelo"] . "| AÑO: " . $row["año"] . "<br>"; ?>
</body>

</html>