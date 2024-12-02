<?php
    class Person{
        private $name;
        private $surname;
        public function getName(){return $this->name;}
        public function getSurname(){return $this->surname;}
        public function setName($name){$this->name=$name;}
        public function setSurname($surname){$this->surname=$surname;}
    }
    $person=new Person();
    $person->setName("Roberto");
    $person->setSurname("González");
    echo "Nombre completo: " .$person->getName(). " " . $person->getSurname();
?>