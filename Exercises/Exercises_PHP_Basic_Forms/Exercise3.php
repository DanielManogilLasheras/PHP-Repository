<html>

<head></head>

<body>
    <?php
    $numeroAleatorio = rand(1, 10);
    $array = array(10);
    for ($i = 0; $i < 11; $i++) {
        $array[$i] = $numeroAleatorio * $i;
    }
    echo "
    <table border='1px solid black'>
    <tr>
        <th>Número generado</th>
    ";
    for ($i = 0; $i < 11; $i++) {
        echo "<th>x$i</th>";
    }
    echo "
    </tr>
    <tr>
        <td>$numeroAleatorio</td>
    ";
    for ($i = 0; $i < 11; $i++) {
        echo "<td>$array[$i]";
    }

    echo "</tr>
    </table>
    ";
    ?>
</body>

</html>