<?php
$error = "";
if (isset($_REQUEST["submit"])){
    session_start();
    $error = $_REQUEST['error'];
    $nombre = $_REQUEST['nombre'];
    if ($nombre != ''){
        session_start();
        $_SESSION['nombre']=$nombre;
        header('location: index.php');

    }else{
        $error = "<p style='color : red'>Escriba un nombre</p>";
    }

}

?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="nombre.php" method="post">
            <div id="error"><?php echo $error ?></div>
            <label for="nombre">Write your name:</label>
            <input type="text" name="nombre" id="nombre"><br/>
            <input type="submit" name="submit" value="enviar">
            <a href="index.php">Home</a>
        </form>
    </body>
</html>