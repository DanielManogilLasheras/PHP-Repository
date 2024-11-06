<html>

<head></head>

<body>
    <?php
    $name = htmlspecialchars($_POST['name']);
    echo "Your name is " . $name . " " . $_POST['surname'] . "<br/>";
    echo "Your interests are:";
    foreach ($_POST['interest'] as $value) {
        echo " " . $value . "<br/>";
    }
    ?>
</body>

</html>