<!DOCTYPE html>
<?php
if (isset($_REQUEST['submit'])) {
    $kb = $_REQUEST['kb'];
    $conversion = $kb / 1024;
    echo $kb . "KB son: " . $conversion . " MB";
} else {


?>
    <html>

    <head></head>

    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="kb">KB</label>
            <input type="text" name="kb">
            <input type="submit" name="submit" value="enviar">
        </form>
    </body>

    </html>

<?php
} ?>