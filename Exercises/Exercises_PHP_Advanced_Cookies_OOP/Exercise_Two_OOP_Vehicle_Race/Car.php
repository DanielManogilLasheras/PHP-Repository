<?php
include_once "Vehicle.php";
class Car extends Vehicle{
    public $capacity;
    public function __construct($capacity) {
        parent::__construct();
        $this->capacity = $capacity;
    }
    public function burnWheel(){
        $value = "WHEEEEEELS";
        return $value;
    }
}
?>