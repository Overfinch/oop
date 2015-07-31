<?php

interface FileNamingStrategy {
    function createLinkName($fileName);
}

class ZipFile implements FileNamingStrategy {
    public function createLinkName($fileName){
        return "/downloads/".$fileName.".zip";
    }
}

class TarGzFile implements FileNamingStrategy {
    public function createLinkName($fileName){
        return "/downloads/".$fileName.".tar.gz";
    }
}

class FileStrategy {
    protected $_type;

    function __construct(){
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Windows")){
            $this->_type = new ZipFile();
        }else{
            $this->_type = new TarGzFile();
        }
    }

    public function getLinkName($name){
        return $this->_type->createLinkName($name);
    }
}

$obj = new FileStrategy();
echo $obj->getLinkName('some_file');
