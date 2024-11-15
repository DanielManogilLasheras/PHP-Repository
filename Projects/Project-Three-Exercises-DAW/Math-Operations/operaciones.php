<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form action="datos_operaciones.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="numeroUno">Introduzca el primer número</label>
                        <input type="text" id="numeroUno" name="numeroUno"><br/>
                    </td>
                    <td style="text-align:center">
                        Seleccione la operacion:
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="numeroDos">Introduzca el segundo número</label>
                        <input type="text" id="numeroDos" name="numeroDos">
                    </td>
                    <td>
                        <input type="radio" name="operacion" id="suma" value="suma">
                        <label for="suma">Suma</label>
                        <input type="radio" name="operacion" id="resta" value="resta">
                        <label for="resta">Resta</label>
                        <input type="radio" name="operacion" id="producto" value="producto">
                        <label for="producto">Producto</label>
                        <input type="radio" name="operacion" id="cociente" value="cociente">
                        <label for="cociente">Cociente</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>