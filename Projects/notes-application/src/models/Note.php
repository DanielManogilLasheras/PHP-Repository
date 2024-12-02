<?php
//We create a namespace to reference it as a class in other files.
namespace Dmano\Notes\models;
use Dmano\Notes\lib\Database;
//We use the PDO and PDOException interfaces to perform the SQL connection operations written in our Database Class
use PDO;
use PDOException;

class Note extends Database
{
    /*We declare our attributes. In this case, I have decied to extend the construct from Database in order to be able to use it's methods
    without the need of repeating the code in every method of our Note class*/
    private string $uuid;
    public function __construct(private $title, private $content)
    {
        parent::__construct();
        //uniqid method is a special method that generates a random uuid. In this case, it will generate a unique id everytime the constructor is called.
        $this->uuid = uniqid();
    }
    public function save()
    {
        //We prepare our query after our connection method and we asign the values to the variables of the note object
        $query = $this->connect()->prepare("INSERT INTO notes (uuid,title,content,updated) VALUES (:uuid,:title,:content, NOW())");
        $query->execute(['title' => $this->title, 'uuid' => $this->uuid, 'content' => $this->content]);
    }
    //As a work in progress, I have created this method but I haven't tested it yet and I haven't added any functionality.
    public function update()
    {
        $query = $this->connect()->prepare("UPDATE notes SET title=:title, content=:content,updated=NOW() WHERE uuid=:uuid");
        $query->execute([Note::getTitle(), Note::getUUID(), Note::getContent()]);
    }
    //Our getters and setters
    public function getUUID()
    {
        return $this->uuid;
    }
    public function setUUID($value)
    {
        $this->uuid = $value;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($value)
    {
        $this->content = $value;
    }
}
