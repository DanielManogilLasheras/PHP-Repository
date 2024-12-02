<?php
use Dmano\Notes\models\Note;
//We store the form fields in variables and we apply XSS protection.
if (count($_POST) > 0) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $message="";
    //We make a simple validation to make sure the fields are not empty
    if ($title != "" || !$content != "") {
        //We create a new Note and we execute the method to store it into the database.
        $note = new Note($title, $content);
        $note->save();
        echo $message="Note successfully written";
    } else {
        echo $message="You must fill all the fields to save the note";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new note</title>
    <link rel="stylesheet" href="src/views/resources/styles.css">
</head>
<body>
    <div id=container>
    <h1>Create note</h1>
    <form action="?view=create" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Insert a title">
        <label for="content">Content:</label>
        <textarea name="content" id="" cols="30" rows="10"> </textarea>
        <input type="submit" value="create note">
    </form>
    </div>
</body>
</html>