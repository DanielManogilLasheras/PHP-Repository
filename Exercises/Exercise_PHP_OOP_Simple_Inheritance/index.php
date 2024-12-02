<?php

class Square{
    protected $base;
    function __construct($base){
        $this->base=$base;
    }
    public function getBase(){return $this->base;}
    public function setBase($base){$this->base=$base;}
}
final class Rectangle extends Square{
    private $height;
    function __construct($base,$height){
        parent::__construct($base);
            $this->height=$height;
        }
    public function getHeight(){return $this->height;}
    public function setHeight($height){$this->height=$height;}
    public function calculate($base,$height){
        $result=$base*$height;
        return $result;
    }
}
$rectangle=new Rectangle(5,3);
$result = "Area of the square: " .$rectangle->calculate($rectangle->getBase(),$rectangle->getHeight());
echo $result;

?>