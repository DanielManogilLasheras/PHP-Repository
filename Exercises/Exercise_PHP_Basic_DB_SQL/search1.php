<?php
session_start();
$_SESSION['result'] = "";
if (isset($_POST['home'])) {
    header("location: index.php");
}
if (isset($_POST['submit'])) {
    session_start();
    echo $_SESSION['result'];
    $_SESSION['idSearch'] = $_POST['idSearch'];
    header("location: search2.php");
}
?>

<html>

<head></head>

<body>
    <form action="search1.php" method="post">
        <label for="id">ID de coche:</label>
        <input type="text" name="idSearch"><br>
        <input type="submit" name="submit" value="Send">
        <input type="submit" name="home" value="home">
    </form>
</body>

</html>