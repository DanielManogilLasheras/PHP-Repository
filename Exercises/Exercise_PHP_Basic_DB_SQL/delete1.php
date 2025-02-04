<?php
if (isset($_POST['home'])) {
    header("location: index.php");
}
if (isset($_POST['submit'])) {
    session_start();
    echo $_SESSION['result'];
    $_SESSION['id'] = $_POST['id'];
    header("location: delete2.php");
}
?>

<html>

<head></head>

<body>
    <form action="delete1.php" method="post">
        <label for="id">ID de coche:</label>
        <input type="text" name="id"><br>
        <input type="submit" name="submit" value="Send">
        <input type="submit" name="home" value="home">
    </form>
</body>

</html>