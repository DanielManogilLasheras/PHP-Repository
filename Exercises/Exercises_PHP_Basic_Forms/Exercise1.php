<html>

<head></head>

<body>
    <?php
    $numero = 0;
    while ($numero <= 100) {
        if (($numero % 5) === 0) {
            echo "<p>El número: $numero es multiplo de 5</p>";
        }
        $numero = $numero + 1;
    }
    ?>
</body>

</html>