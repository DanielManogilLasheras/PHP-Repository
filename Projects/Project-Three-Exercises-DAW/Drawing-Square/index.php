<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    $nums = [rand(5, 15), rand(5, 15)];
    echo "<p>Alto: " . $nums[0] . "</p>";
    echo "<p>Ancho: " . $nums[1] . "</p>";
    for ($i = 0; $i < $nums[0]; $i++) {
        for ($j = 0; $j < $nums[1]; $j++) {
            echo "* ";
        }
        echo "<br/>";
    }
    ?>
</body>

</html>