<?php
if (isset($_REQUEST['submit'])){
    $numOne = $_REQUEST['numOne'];
    $numTwo = $_REQUEST['numTwo'];
    $numThree =  $_REQUEST['numThree'];
    if ($numOne != '' && $numTwo != '' && $numThree != ''){
        echo "aaaa";
        $array=array($_POST["numOne"],$_POST["numTwo"],$_POST['numThree']);
        $number=0;
        $result = $_POST["result"];
        for ($i = 0 ; $i < count($array) ; $i++){
            if ($array[$i] > $number){
                $number = $array[$i];
            }else{
            }
        }
        $result = "<p>The biggest number among the three is " .$number. "</p>";
    }else{
        $result = "<p>All numbers must be inserted</p>";
    }
    echo $result;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <form id="form" action="index.php" method="post">
            <label for="numOne">Escribe número 1:</label>
            <input type="text" id="numOne" name="numOne"><br/>
            <label for="numTwo">Escribe número 1:</label>
            <input type="text" id="numTwo" name="numTwo"><br/>
            <label for="numThree">Escribe número 1:</label>
            <input type="text" id="numThree" name="numThree"><br/>
            <div name="result"></div>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </body>
</html>