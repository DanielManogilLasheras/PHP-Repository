<?php
setcookie("lastAccess",date("d-m-Y"));
echo "Hola, no nos visitabas desde: " .$_COOKIE['lastAccess'];
$name='';
$surname='';
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form name= action="" method="POST">
            <label for="name" >Name</label>
            <input type="text" value="<?php $name ?>"name="name">
            <label for="surname">Surname</label>
            <input type="text" value="<?php $surname?>" name="surname">
        </form>
    </body>
</html>