<?php

class Conf {
    private $file;
    private $xml;
    private $lastmatch;

    function __construct($file){
        $this->file = $file;
        $this->xml = simplexml_load_file($file);
    }

    function write(){
        file_put_contents($this->file, $this->xml->asXML());
    }

    function get($str){
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if(count($matches)){
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }
    }

    function set($key, $value){
        if(! is_null($this->get($key))){
            $this->lastmatch[0] = $value;
            return;
        }
        //$conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}

$config = new Conf("file.xml");
$config->set('sex','male'); // назначает значение
$config->write(); // записывает в файл
echo $config->get('sex'); // выводит значение