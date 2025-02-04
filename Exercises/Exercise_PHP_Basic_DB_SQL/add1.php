<?php
if (isset($_POST['home'])) {
    header("location: index.php");
}
if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['brand'] = $_POST['brand'];
    $_SESSION['model'] = $_POST['model'];
    $_SESSION['year'] = $_POST['year'];
    header("location: add2.php");
    exit;
}
?>


<html>

<head></head>

<body>
    <form action="add1.php" method="post">
        <label for="brand">Model:</label>
        <input type="text" name="brand"><br>
        <label for="model">Model:</label>
        <input type="text" name="model"><br>
        <label for="year">Year:</label>
        <input type="text" name="year"><br>
        <input type="submit" name="submit">
        <input type="submit" name="home" value="home">
    </form>
</body>

</html>