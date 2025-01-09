<?php
//We create a variable for the color displayed in our screen, white by default;
$colorNow = "white";
//We check if we pressed the button of cleansing the cookies, to prevent having opposing instructions in our algorithm
if(isset($_POST["cleanse"])){
    setCookie("cookieColor","white",time() - 60);
}else{
    //We check if the cookie has been already created, in which case we store it's value in the variable used to display the color
    if(isset($_COOKIE["cookieColor"])){
        $colorNow = $_COOKIE["cookieColor"];
    }else{
        //If the cookie hasn't been created, we create it with white as default
        setcookie("cookieColor","white", time() + 2 * 24 * 3600);
    }
    if(isset($_POST["submit"])){
        //when we change color, we retrieve the value form the form, we change the current color (white or from the cookie) and we modify the cookie already created
        $colorSelected=$_POST["color"];
        $colorNow = $colorSelected;
        setcookie("cookieColor",$colorSelected, time() + 2 * 24 * 3600);
    }
}
?>
<html>
    <head>
        <style>
            body{
                background: <?php echo $colorNow?>;
            }
        </style>
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="radio" name="color" id="color_green" value="green">
            <label for="color_green">Green</label>
            <input type="radio" name="color" id="color_red" value="red">
            <label for="color_red">Red</label>
            <input type="radio" name="color" id="color_blue" value="blue">
            <label for="color_blue">Blue</label>
            <input type="submit" value="submit" name="submit">
            <input type="submit" value="cleanse Cookies" name="cleanse">
        </form>
    </body>
</html>