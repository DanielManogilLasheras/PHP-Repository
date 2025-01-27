<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $firstSurname = $_POST['firstSurname'];
    $secondSurname = $_POST['secondSurname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $contact = $name . ' ' . $firstSurname . ' ' . $secondSurname . ' ' . $email . ' ' . $telephone . PHP_EOL;
    $file = fopen('contacts.txt', 'a');
    fwrite($file, $contact);
    fclose($file);
} else if (isset($_POST['back'])) {
    header('location:index.php');
}
?>

<html>

<head></head>

<body>
    <form action="crear.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name"><br>
        <label for="surnameOne">First surname:</label>
        <input type="text" name="firstSurname"><br>
        <label for="surnameTwo">Second surname:</label>
        <input type="text" name="secondSurname"><br>
        <label for="email">Email:</label>
        <input type="email" name="email"><br>
        <label for="telephone">Telephone:</label>
        <input type="text" name="telephone"><br>
        <input type="submit" name="submit" value="Create contact">
        <input type="submit" name="back" value="Go back">

    </form>
</body>

</html>