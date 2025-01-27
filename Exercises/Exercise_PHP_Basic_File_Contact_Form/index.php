<?php
if (isset($_POST['createContact'])) {
    header('location:crear.php');
} else if (isset($_POST['viewContacts'])) {
    header('location:view.php');
}
?>


<html>

<head></head>

<body>
    <form name="menuForm" action="index.php" method="post">
        <input type="submit" name="createContact" value="Create contact">
        <input type="submit" name="viewContacts" value="View contacts">
    </form>
</body>

</html>