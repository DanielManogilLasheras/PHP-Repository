<?php
class Rectangle{
    private $base;
    private $height;

    public function __construct($b=1, $h=2){
        $this->base = $b;
        $this->height = $h;
    }    public function getBase(){return $this->base;}
    public function getHeight(){return $this->height;}
    public function setBase($base){$this->base=$base;}
    public function setHeight($height){$this->height=$height;}
    public function getSurface() { return $this->base * $this->height; }
    
}

$rectangle=new Rectangle();
$rectangle->setBase(3);
$rectangle->setHeight(5);
echo "The rectangle has a surface of: " .$rectangle->getBase();
echo "The rectangle has a height of: " .$rectangle->getHeight();
echo "The area of the rectangle is " .$rectangle->getBase()*$rectangle->getHeight();

$rectangle5=new Rectangle(4,5);
echo "El rectángulo de ".$rectangle5->getBase()." *
".$rectangle5->getHeight();
echo "tiene una superﬁcie de ".$rectangle5->getSurface()."<br/>";