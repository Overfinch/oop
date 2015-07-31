<?php
    
class PC {
    
    private $CPU;
    private $RAM;
    private $os;
    private $typeCase;
    
    const PI = 3.14;
    
    public static $E = 2.7;

    public function __construct($argCPU, $argRAM, $argOS, $argTC){
        $this->CPU = $argCPU;
        $this->RAM = $argRAM;
        $this->os  = $argOS;
        $this->typeCase = $argTC;
        echo self::PI ."<br>";
    }
    
    public function getPropertyCPU() {
        return $this->CPU;
    }
    
    /*
    public function __destruct() {
        echo "Object Deleted";
    }
     */
    
    public function __toString() {
        return "<hr>".$this->showDescription()."<br>";
    }
    
    public function __clone() {
        echo "<h1>Object cloned</h1>";
    }
    
    

    public function showInfo() {
        echo "1) CPU = ".$this->CPU."<br>";
        echo "2) RAM = ".$this->RAM."<br>";
        echo "3) TYPE = ".$this->typeCase."<br>";
        echo $this->showDescription();
    }
    
    public function showDescription() {
        return $this->os." Memory;". $this->RAM." CPU;". $this->CPU;
    }
}

//$pc = new PC(2.5,2000,"MAC OS", "Desctop");

echo PC::PI;

echo '<br>';

echo PC::$E;

?>

