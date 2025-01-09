<?php
include_once "Vehicle.php";

class Car extends Vehicle{
    public $cylinder;
    public function __construct($cylinder) {
        parent::__construct(0,1);
        $this->cylinder = $cylinder;
    }
    public function burnWheel(){
        $value = "WHEEEEEELS";
        return $value;
    }
}