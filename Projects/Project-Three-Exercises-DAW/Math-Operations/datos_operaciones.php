<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
        try{
            $numeroUno=htmlspecialchars($_POST['numeroUno']) ;
            $numeroDos=htmlspecialchars($_POST['numeroDos']);
            $opSeleccionada=$_POST['operacion'];
            switch($opSeleccionada){
                case "suma";
                    $result=$numeroUno+$numeroDos;
                    echo "El resultado de sumar " .$numeroUno. " y " .$numeroDos. " es " .$result;
                break;
                case "resta";
                    $result=$numeroUno-$numeroDos;
                    echo "El resultado de restar " .$numeroUno. " y " .$numeroDos. " es " .$result;
                break;
                case "producto";
                    $result=$numeroUno*$numeroDos;
                    echo "El resultado de multiplicar " .$numeroUno. " y " .$numeroDos. " es " .$result;
                break;
                case "cociente";
                    $result=$numeroUno/$numeroDos;
                    echo "El resultado de dividir " .$numeroUno. " y " .$numeroDos. " es " .$result;
                break;
            }
        }catch(DivisionByZeroError $e){
                header("location:operaciones.php?message=Not possible to divide by 0");
            }
        

        ?>
    </body>
</html>