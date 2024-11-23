<?php
if (isset($_REQUEST['submit'])) {
    $numOne = $_REQUEST['numOne'];
    $numTwo = $_REQUEST['numTwo'];
    $suma = $numOne + $numTwo;
    $resta = $numOne - $numTwo;
    $divi = $numOne / $numTwo;
    $multi = $numOne * $numTwo;
    echo "<p>Suma: " . $suma . "</p>";
    echo "<p>Resta: " . $resta . "</p>";
    echo "<p>Multi: " . $multi . "</p>";
    echo "<p>Divi: " . $divi . "</p>";
} else {
?>
    <html>

    <head>
        <meta charset="UTF-8">
    </head>

    <body>
        <form action="index.php" method="POST">
            <input type="text" name="numOne">
            <input type="text" name="numTwo">
            <input type="submit" name="submit" value="Enviar">
        </form>

    </body>

    </html>

<?php } ?>