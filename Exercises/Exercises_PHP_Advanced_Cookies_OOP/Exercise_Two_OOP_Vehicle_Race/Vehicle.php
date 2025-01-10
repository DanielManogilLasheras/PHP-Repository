<?php
class Vehicle{
    public static $km_total = 0;
    public static $vehiclesCreated=0;
    public $km_done;

    public function __construct() {
        self::$vehiclesCreated++;
    }
    public static function getKmTotal(){
        return self::$km_total;
    }
    public static function getVehiclesCreated(){
        return  self::$vehiclesCreated;
    }
    public function getKmDone(){
        return $this->km_done;
    }
    public function runKm($km){
        self::$km_total += $km;
        $this->km_done += $km;
    }
}
?>