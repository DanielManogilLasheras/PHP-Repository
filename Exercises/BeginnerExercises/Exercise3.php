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
        <th>x0</th>
        <th>x1</th>
        <th>x2</th>
        <th>x3</th>
        <th>x4</th>
        <th>x5</th>
        <th>x6</th>
        <th>x7</th>
        <th>x8</th>
        <th>x9</th>
        <th>x10</th>
    </tr>
    <tr>
        <td>$numeroAleatorio</td>";
    for ($i = 0; $i < 11; $i++) {
        echo "<td>$array[$i]";
    }

    echo "</tr>
    </table>
    ";
    ?>
</body>

</html>