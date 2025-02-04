<?php
session_start();
echo $_SESSION['result'];
if (isset($_POST['addCar'])) {
    header("location: add1.php");
}
if (isset($_POST['deleteCar'])) {
    header("location: delete1.php");
}
if (isset($_POST['listCars'])) {
    header("location: list.php");
}
if (isset($_POST['searchCar'])) {
    header("location: search1.php");
}
?>
<!DOCTYPE html>
<html>

<head></head>

<body>
    <form action="index.php" method="post" name="basicForm">
        <input type="submit" name="addCar" value="Crear coche">
        <input type="submit" name="deleteCar" value="Borrar un coche">
        <input type="submit" name="listCars" value="Listar coches">
        <input type="submit" name="searchCar" value="Buscar coche">
    </form>
</body>

</html>