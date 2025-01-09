<?php
class Vehicle{
    public $km_total;
    public $vehiclesCreated=0;
    public $km_done=0;

    public function __construct($km_total , $vehiclesCreated) {
        $this->$km_total += $km_total;
        $this->$vehiclesCreated += $vehiclesCreated;
    }
    public function getKmTotal(){
        return $this->km_total;
    }
    public function getVehiclesCreated(){
        return $this->vehiclesCreated;
    }
    public function getKmDone(){
        return $this->km_done;
    }
    public function runKm($km){
        $this->km_total += $km;
        $this->km_done += $km;
    }
}