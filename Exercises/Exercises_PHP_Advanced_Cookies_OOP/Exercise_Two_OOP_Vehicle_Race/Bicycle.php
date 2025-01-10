<?php
include_once "Vehicle.php";
class Bicycle extends Vehicle{
    public $gears;
    public function __construct($gears) {
        parent::__construct();
        $this->gears = $gears;
    }
    public function wheelie(){
        $value = "wheelieeeeeeee!!!";
        return $value;
    }
}
?>