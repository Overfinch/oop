<?php

class CounterMashine {
    
    protected $width;
    protected $height;
    
    public function sum($a,$b){
        return $a + $b;
    }
    
    public function __construct($w, $h) {
        $this->width = $w;
        $this->height = $h;
    }
    
    public function showInfo() {
        echo $this->width.'<br>';
        echo $this->height.'<br>';
    }
    
    
    
}

class PC extends CounterMashine {
    
    private $type;
    private $os;
    private $software = array();
    
    public function __construct($w, $h, $os, $t, $sw) {
        parent::__construct($w, $h);
        $this->os = $os;
        $this->type = $t;
        $this->software = $this->parseProgramms($sw);
    }
    
    public function showInfo() {
        parent::showInfo();
        echo '<br>';
        echo '<pre>';
        print_r($this->software);
        echo '</pre>';
    }


    private function parseProgramms($string){
        $programms = explode(";", $string);
        
        for ($i = 0; $i < count($programms); $i++) {
            $info = explode("|", $programms[$i]);
            $this->software[$info[0]] = $info[1];
        }
        return $this->software;
    }
}

$computer = new PC(300, 250, "windows 8", 'laptop','Name|C:/PF/np.exe;Name2|C:/PF/np2.exe');
$computer->showInfo();
echo $computer->sum(10, 20);