<!DOCTYPE html>
<html>

<head></head>

<body>
    <?php
    session_start();
    echo "<p>Nombre: " . $_SESSION['nombre'] . "</p>";
    echo "<p>Apellidos: " . $_SESSION['apellidos'] . "</p>";
    echo "<p>Estado civil: " . $_SESSION['estadoCivil'] .  "</p>";
    echo "<p>Edad: " . $_SESSION['edad'] . "</p>";
    echo "<p>Peso: " . $_SESSION['peso'] . "</p>";
    echo "<p>Aficiones:";
    foreach ($_SESSION['aficiones'] as $item) {
        echo "-" . $item . ".";
    }
    echo "</p>";
    session_destroy();
    ?>
</body>

</html>