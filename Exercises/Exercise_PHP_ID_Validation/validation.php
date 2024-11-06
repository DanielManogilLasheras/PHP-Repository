<html>

<head></head>

<body>
    <?php
    $id = $_POST["id"];
    $patron = '/^[0-9]{8}[A-Z]{1}$/';
    if (preg_match($patron, $id)) {
        echo "ID is correct";
    } else {
        echo "The ID format is wrong";
    }
    ?>
</body>

</html>