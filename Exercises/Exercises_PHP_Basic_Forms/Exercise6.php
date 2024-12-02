<html>

<head></head>

<body>
    <?php
    $arrayJug1 = array(3);
    $arrayJug2 = array(3);
    for ($i = 0; $i < 3; $i++) {
        $arrayJug1[$i] = rand(1, 6);
        $arrayJug2[$i] = rand(1, 6);
    }
    echo "<p>Tiradas del jugador 1:</p>";
    for ($i = 0; $i < 3; $i++) {
        echo "<img src='resources/$arrayJug1[$i].jpg'>";
    }
    echo "<p>Tiradas del jugador 2:</p>";
    for ($i = 0; $i < 3; $i++) {
        echo "<img src='resources/$arrayJug2[$i].jpg'>";
    }
    if (array_sum($arrayJug1) > array_sum($arrayJug2)) {
        echo "<p>El jugador 1 ha ganado.</p>";
    } else
    if (array_sum($arrayJug1) < array_sum($arrayJug2)) {
        echo "<p>El jugador 2 ha ganado.</p>";
    } else
    if (array_sum($arrayJug1) === array_sum($arrayJug2)) {
        echo "<p>Hay un empate.</p>";
    }
    ?>
</body>

</html>