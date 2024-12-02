<?php
session_start();
$error = [" ", " ", " ", " "];
$valid = true;
if (isset($_REQUEST['submit'])) {
    if (htmlspecialchars($_REQUEST['nombre']) == '') {
        $error[0] = '<span style="color:red">Ingrese nombre</span>';
        $valid = false;
    }
    if (htmlspecialchars($_REQUEST['apellidos']) == '') {
        $error[1] = '<span style="color:red">Ingrese apellido</span>';
        $valid = false;
    }
    if (htmlspecialchars($_REQUEST['peso']) == '') {
        $error[2] = '<span style="color:red">Ingrese peso</span>';
        $valid = false;
    }
    if (!isset($_REQUEST['aficiones'])) {
        $error[3] = '<span style="color:red">*</span>';
        $valid = false;
    }
    if (!isset($_REQUEST['sexo'])) {
        $error[3] = '<span style="color:red">*</span>';
        $valid = false;
    }
    if (!isset($_REQUEST['estadoCivil'])) {
        $error[3] = '<span style="color:red">*</span>';
        $valid = false;
    }
    if (htmlspecialchars($_REQUEST['edad']) == '') {
        $error[0] = '<span style="color:red">*</span>';
        $valid = false;
    }
    if ($valid) {
        $_SESSION['nombre'] = htmlspecialchars($_POST['nombre']);
        $_SESSION['apellidos'] = htmlspecialchars($_POST['apellidos']);
        $_SESSION['edad'] = htmlspecialchars($_POST['edad']);
        $_SESSION['peso'] = $_POST['peso'];
        $_SESSION['sexo'] = htmlspecialchars($_POST['sexo']);
        $_SESSION['estadoCivil'] = htmlspecialchars($_POST['estadoCivil']);
        $_SESSION['aficiones'] = $_POST['aficiones'];
        header("Location: respuesta.php");
        exit;
    }
}
?>
<html>

<head></head>

<body>
    <p>Escriba los siguientes datos</p>
    <table>
        <tr>
            <td>
                <form action="index.php" method="post">
                    <label for="nombre">Nombre:</label> <?php echo $error[0] ?><br />
                    <input type="text" name="nombre">
            </td>
            <td>
                <label for="apellidos">Apellidos:</label> <?php echo $error[1] ?><br />
                <input type="text" name="apellidos">
            </td>
            <td>
                <label for="edad">Edad:</label> <?php echo $error[3] ?><br />
                <select name="edad" id="edad">
                    <option value="primeraEdad"></option>
                    <option value="Entre 10 y 29 años">Entre 10 y 29 años</option>
                    <option value="Entre 29 y 59 años">Entre 29 y 59 años</option>
                    <option value="Mayor de 60 años">Mayor de 60 años</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="peso">Peso: </label> <?php echo $error[2] ?><br />
                <input type="number" name="peso" id="peso">
            </td>
            <td>
                <label for="sexo">Sexo: </label> <?php echo $error[3] ?><br />
                <input type="radio" id="hombre" name="sexo" value="hombre">
                <label for="hombre">Hombre</label>
                <input type="radio" id="mujer" name="sexo" value="mujer">
                <label for="mujer">Mujer</label>

            </td>
            <td>
                <label for="estadoCivil">Estado civil</label> <?php echo $error[3] ?><br />
                <input type="radio" name="estadoCivil" id="soltero" value="soltero">
                <label for="soltero">Soltero</label>
                <input type="radio" name="estadoCivil" id="casado" value="casado">
                <label for="casado">Casado</label>
                <input type="radio" name="estadoCivil" id="otro" value="otro">
                <label for="otro">otro</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Aficiones:</label> <?php echo $error[3] ?>
                <div>
                    <input type="checkbox" name="aficiones[]" id="cine" value="cine">Cine</input>
                    <input type="checkbox" name="aficiones[]" value="literatura">Literatura</input>
                    <input type="checkbox" name="aficiones[]" value="tebeos">Tebeos</input>
                    <input type="checkbox" name="aficiones[]" value="deporte">Deporte</input>
                    <input type="checkbox" name="aficiones[]" value="musica">Música</input>
                    <input type="checkbox" name="aficiones[]" value="television">Televisión</input>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="enviar" name="submit">
                <input type="reset" value="borrar" name="">
            </td>

        </tr>
    </table>
    </form>
</body>

</html>