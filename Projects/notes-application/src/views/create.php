<?php

use Dmano\Notes\models\Note;

if (count($_POST) > 0) {
    $title = isset($_POST['title']) ?? '';
    $content = isset($_POST['content']) ?? '';
    $note = new Note($title, $content);
    $note->save();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new note</title>
</head>

<body>
    <h1>Create note</h1>
    <form action="?view=create" method="POST">
        <input type="text" name="title" placeholder="Insert a title">
        <textarea name="content" id="" cols="30" rows="10"> </textarea>
        <input type="submit" value="create note">
    </form>
</body>

</html>