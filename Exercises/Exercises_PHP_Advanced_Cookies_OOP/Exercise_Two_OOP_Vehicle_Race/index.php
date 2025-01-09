<?php
include_once "Car.php";
include_once "Bicycle.php";

$myBicycle = new Bicycle("24");
$myCar = new Car(1500);

$myBicycle->runKm(40);
$myCar->runKm(200);
echo $myBicycle->wheelie()."<br>";
echo $myCar->burnWheel()."<br>";
$myBicycle->runKm(60);
echo "My bicycle has made " . $myBicycle->getKmDone(). "km<br>";
echo "My car has made " . $myCar->getKmDone() . "km<br>";
echo "You have created " . $Vehicle::getVehiclesCreated(). " vehicles in total<br>";
echo "You have run " . $Vehicle::getKmTotal(). "km in total";
