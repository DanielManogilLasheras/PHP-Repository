<!DOCTYPE html>
<?php
if (isset($_REQUEST['submit'])) {
    $horas = $_REQUEST['horas'];
    $paga = $horas * 12;
    echo "<p>Su salario es" . $paga . "</p>";
}
?>
<html>

<head></head>

<body>
    <form action="index.php" method="post">
        <label for="horas">Introduzca las horas trabajadas</label>
        <input type="text" name="horas">
        <input type="submit" name="submit" value="enviar">
    </form>
</body>

</html>