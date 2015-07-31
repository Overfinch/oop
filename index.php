<?php
    
class PC {
    
    public $CPU;
    public $RAM;
    public $os;
    public $typeCase;
    

    public function __construct($argCPU, $argRAM, $argOS, $argTC){
        $this->CPU = $argCPU;
        $this->RAM = $argRAM;
        $this->os  = $argOS;
        $this->typeCase = $argTC;
    }
    
    public function __destruct() {
        echo "Object Deleted";
    }
    
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

$pc = new PC(2.5, 2000, "MAC OS", "Desctop");

$pc->showInfo();
$pc->CPU = 2.7;
echo '<br><br>';
$pc->showInfo();
echo '<br><br>';
echo $pc;
echo "<hr><div style='height:10px; background-color:red;'></div>";

$pc2 = new PC(3.5,7000,"Windows XP", "Tower");
$pc3 = clone $pc2;

$pc2->showInfo();
$pc2->CPU = 2.7;
echo '<br><br>';
$pc2->showInfo();
echo '<br><br>';
echo $pc2;
echo "<hr><div style='height:10px; background-color:red;'></div>";



$pc3->showInfo();
//$pc3->CPU = 2.7;
echo '<br><br>';
$pc3->showInfo();
echo '<br><br>';
echo $pc3;
echo "<hr><div style='height:10px; background-color:red;'></div>";
       
?>
