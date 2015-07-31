<?php

class Conf {
    private $file;
    private $xml;
    private $lastmatch;

    function __construct($file){
        $this->file = $file;

        if(! file_exists($file)){
            throw new FileException("Файл $file не существует");
        }
        $this->xml = simplexml_load_file($file, Null, LIBXML_NOERROR);
        if(!is_object($this->xml)){
            throw new XmlException(libxml_get_last_error());
        }

        $matches = $this->xml->xpath("/conf");
        if(!count($matches)){
            throw new ConfException("корневой элемент conf не найден");
        }
    }

    function write(){
        if(!is_writable($this->file)){
            throw new FileException("файл $this->file не доступен для записи");
        }
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

Class XmlException extends Exception{ // класс оброботки XML-исключений, который дополняет основной класс исключений
    private $error;

    function __construct(LibXMLError $error){ // при создании исключения, принимает (ошибку) обьект класса LibXMLError
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, строка {$error->line}, ";
        $msg .= "колонка {$error->column}] {$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code); //передаёт в конструктор родительского класса сообщение, и код ошибки
    }

    function getLibXmlError(){
        return $this->error;
    }
}

class FileException extends Exception{}
class ConfException extends Exception{}

class Runner {
    static function init(){
        try{
            $config = new Conf("file.xml");
            $config->set('sex','male'); // назначает значение
            $config->write(); // записывает в файл
            echo "sex: ".$config->get('sex'); // выводит значение
        }catch (FileException $e){
            die($e->__toString()); //файл не существует либо не доступен для записи
        }catch (XmlException $e){
            die($e->__toString()); //Повреждённый XML-файл
        }catch (ConfException $e){
            die($e->__toString()); //не корректный формат XML-файла
        }catch (Exception $e){
            die($e->__toString()); // Этот код не долже никогда вызываться
        }
    }
}

Runner::init();



