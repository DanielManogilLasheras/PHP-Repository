<?php
session_start();
$_SESSION['result'] = "";
if (isset($_POST['home'])) {
    header("location: index.php");
}
$connection = mysqli_connect("localhost", "root", "", "concesionario");
$sql = "SELECT * FROM coches";
$query = mysqli_query($connection, $sql)
    or die("Fallo en la consulta sql");
$nrows = mysqli_num_rows($query);

?>
<html>

<head>

</head>

<body>
    <form action="index.php" method="post">
        <input type="submit" name="home" value="Home">
    </form>
    <h2>Lista de coches:</h2>
    <?php
    if ($nrows > 0) {
        for ($i = 0; $i < $nrows; $i++) {
            $row = mysqli_fetch_assoc($query);
            echo "ID: " . $row["id"] . "|  MARCA: " . $row["marca"] . "| MODELO:  " . $row["modelo"] . "| AÑO: " . $row["año"] . "<br>";
        }
    }
    ?>
</body>

</html>