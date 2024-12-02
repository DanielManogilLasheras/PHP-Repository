<html>

<head></head>

<body>
    <?php
    $num = rand(0, 9999);
    $posiciones = strlen($num);
    echo "<p> El número generado es $num</p>";
    echo "<p> El numero de dígitos de $num es $posiciones";
    ?>
</body>

</html>