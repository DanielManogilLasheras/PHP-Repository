<!DOCTYPE html>
<html>

<head>
    <style>
        .bolded {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    session_start();
        echo "<p>Nombre: <span class='bolded'>" . $_SESSION['nombre'] . "</span></p>";
        echo "<p>Apellidos: <span class='bolded'>" . $_SESSION['apellidos'] . "</span></p>";
        echo "<p>Estado civil: <span class='bolded'>" . $_SESSION['estadoCivil'] .  "</span></p>";
        echo "<p>Edad: <span class='bolded'>" . $_SESSION['edad'] . "</span></p>";
        echo "<p>Peso: <span class='bolded'>" . $_SESSION['peso'] . "</span></p>";
        echo "<p>Aficiones:";
        foreach ($_SESSION['aficiones'] as $item) {
            echo "-<span class='bolded'>" . $item . "</span>.";
        }
        echo "</p>";
        session_destroy();

   
    ?>
</body>

</html>