<html>

<head></head>

<body>
    <?php
        echo "Resultados:<br/>";
            $arrayJug1 = array(5);
            $arrayJug2 = array(5);
            for ($i = 0; $i < 5; $i++) {
            $arrayJug1[$i] = rand(1, 6);
            $arrayJug2[$i] = rand(1, 6);
            $result=array(0,0);
            }
            echo "<p>Tiradas del jugador 1:</p>";
            for ($i = 0; $i < 5; $i++) {
                echo "<img src='resources/$arrayJug1[$i].jpg'>";
                $result[0]+=$arrayJug1[$i];
            }
                echo "<p>Tiradas del jugador 2:</p>";
            for ($i = 0; $i < 5; $i++) {
                echo "<img src='resources/$arrayJug2[$i].jpg'>";
                $result[1]+=$arrayJug2[$i];
            }
            echo "<br/>";
            echo "Resultados <br/>";
            echo "Jugador 1: " .$result[0]. "<br/>" ;
            echo "Jugador 2: " .$result[1]. "<br/>";
            if (array_sum($arrayJug1) > array_sum($arrayJug2)) {
                echo "<p>El jugador 1 ha ganado.</p>";
            } else if (array_sum($arrayJug1) < array_sum($arrayJug2)) {
                echo "<p>El jugador 2 ha ganado.</p>";
    
            } else if (array_sum($arrayJug1) === array_sum($arrayJug2)) {
                echo "<p>Hay un empate.</p>";
            }

    ?>
</body>

</html>