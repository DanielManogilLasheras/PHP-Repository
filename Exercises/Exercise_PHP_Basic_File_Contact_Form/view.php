<?php
if (isset($_POST['back'])) {
    header('location:index.php');
} else {
    $file = fopen('contacts.txt', 'r');
    while (!feof($file)) {
        $contact = fgets($file);
        echo $contact . '<br>';
    }
}


?>

<html>

<head></head>

<body>
    <form action="index.php" method="post">
        <input type="submit" name="back" value="Go back">
    </form>
</body>

</html>