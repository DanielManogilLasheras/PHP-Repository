<html>

<head></head>

<body>
    <?php
    function operation()
    {
        $numero = rand(5, 20);
        $cuadrado = $numero * $numero;
        $result = "
            <tr>
                <td>$numero</td>
                <td>$cuadrado</td>
            </tr>";
        return $result;
    }
    echo "
    <table border='1px solid black'>
    <tr>
        <th>Número generado</th>
        <th>Su cuadrado es:</th>
    </tr>";
    for ($i = 0; $i < 10; $i++) {
        echo operation();
    }
    echo "</table>";
    ?>
</body>

</html>