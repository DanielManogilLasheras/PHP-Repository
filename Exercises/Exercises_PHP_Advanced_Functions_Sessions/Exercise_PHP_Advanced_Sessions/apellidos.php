<?php
$error = "";
if (isset($_REQUEST["submit"])){
    session_start();
    $error = $_REQUEST['error'];
    $apellidos = htmlspecialchars($_REQUEST['apellidos']);
    if ($apellidos != ''){
        session_start();
        $_SESSION['apellidos']=$apellidos;
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
        <form action="apellidos.php" method="post">
            <div id="error"><?php echo $error ?></div>
            <label for="apellidos">Write your name:</label>
            <input type="text" name="apellidos" id="apellidos"><br/>
            <input type="submit" name="submit" value="enviar">
            <a href="index.php">Home</a>
        </form>
    </body>
</html>