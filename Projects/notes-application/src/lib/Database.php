<?php
//We create a namespace to be able refer to it in other files.
namespace Dmano\Notes\lib;
use PDO;
use PDOException;

class Database
{
    /*I tried to stablish the connection parameters through a constructor but I could not make it work.
    As I'm still learning the full extend and logic of the PDO, for the moment I have overridden it with specific parameters,
    although I know this doesn't provide any encapsulation.
    */
    public function __construct() {}
    public function connect()
    {
        try {
            $user = 'root';
            $password = '';
            $connection = 'mysql:host=localhost;dbname=NOTES;charset=utf8mb4';
            $pdo = new PDO($connection, $user, $password);
            return $pdo;
        } catch (PDOException $e) {
            //Catching the exception in this way helped me retrieve the errors to make the code work.
            echo "exception...";
            print $e->getMessage() . "\n";
            printf(format: (int)$e->getCode() . "\n");
            die();
        }
    }
}
