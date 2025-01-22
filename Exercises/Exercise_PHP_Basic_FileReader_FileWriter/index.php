<?php
$nombre_archivo = "casa.txt";
$mensaje = "Hoy es jueves";
//Verificacion de archivo
if(file_exists($nombre_archivo )) {
    if(is_file($nombre_archivo )) {
        if(is_writable($nombre_archivo )) {
            echo "El ﬁchero"  .$nombre_archivo. "  existe y se puede modiﬁcar <br><br>";
        }
    }
    else { echo $nombre_archivo.   "no es un ﬁchero"; }
}
else { echo "$nombre01 no existe"; }

//Lectura
$fd = fopen ($nombre_archivo, "r");
echo "el contenido del fichero es: <br>";
while (!feof($fd)){
    $lectura = $fgets ($fd);
    echo $lectura. "<br>";
}
fclose($fd);

//escritura
$archivo = fopen($nombre_archivo, "a");
echo $archivo;
fputs ($archivo, $mensaje . PHP_EOL);
echo "<br> fichero grabado";
fclose($archivo);
?>