<?php

abstract class Auto{
    protected $type;
    protected $maxSpeed;
    protected $color;
    protected $x;
    protected $y;
    
    public function __construct(
                                $cordX = 0,
                                $cordY = 0,
                                $type = "car",
                                $maxSpeed = 90,
                                $color = "#ff0000") {
        $this->x = $cordX;
        $this->y = $cordY;
        $this->type = $type;
        $this->maxSpeed = $maxSpeed;
        $this->color = $color;
    }
    
    abstract function setType($type);

    public function getCoords() {
        return "(".$this->x." ; ".$this->y.")";
    }
    
    public function showAuto() {
        echo "<div style='display:block; padding:20px; background:".$this->color."'> (".$this->x." ; ".$this->y." )<br>
               ".$this->type."<br>
               ".$this->maxSpeed." km/h<br>
                 </div>";
    }


    public function move($cordX,$cordY) {
        $this->x = $cordX;
        $this->y = $cordY;
        return $this->getCoords();
    }
}

class Car extends Auto {
    public function setType($type) {
        $this->type = $type;
    }
}

class Truck extends Auto {
    private $capacity;
    
    public function __construct($cordX = 0, $cordY = 0, $type = "truck", $maxSpeed = 90, $color = "#ff0000",$capacity=0) {
        parent::__construct($cordX, $cordY, $type, $maxSpeed, $color);
        $this->capacity = $capacity;
        
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function showAuto() {
        parent::showAuto();
        echo "<div style='display:block; padding:20px; background:".$this->color."'><br>".$this->capacity." kg</div>";
        
    }
}

echo '<h1>Class Car</h1><hr>';


$variable = "Car";
$car = new $variable(200,30);
echo $car->getCoords();
$car->move(400, 300);
echo $car->getCoords();
echo $car->showAuto();

if (method_exists($car,"setType")) {
    echo 'Method setType exist<br>';
}

if (property_exists($car,"x")) {
    echo 'property x exist<br>';
}

if (class_exists("Car")) {
    echo 'class Car exist<br>';
}
    


echo '<hr>';

echo '<h1>Class Truck</h1><hr>';

$truck = new Truck(200,30,"Truck",120,"#00ff00",3000);
$truck->move(200, 100);
echo $truck->showAuto();
echo '<hr>';