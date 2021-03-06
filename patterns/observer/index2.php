<?php
// Observer
// аналог предыдущего примера, с использованием SPL
// SPL -это набор инструментов, которые помогают решать распространенные объектно-ориентированные задачи.
// То, что в SPL имеет отношение к шаблону Observer, состоит из трех элементов: SplObserver, SplSubj ect и SplObj ectStorage.


abstract class LoginObserver implements SplObserver {
    private $login;

    function __construct(Login $login){ // наблюдатель сам "заклепляется" за объектомЮ при создании
        $this->login = $login;
        $login->attach($this);
    }

    function update(SplSubject $observable){
        if($observable === $this->login){
            $this->doUpdate($observable);
        }
    }

    abstract function doUpdate(Login $login);
}

class Login  implements SplSubject { // объект за которым будут наблюдать наблюдатели
    private $storage;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    private $status = [];

    function __construct(){
        $this->storage = new SplObjectStorage();
    }

    function attach(SplObserver $observer){ // прикрепляем наблюдателя к объекту
        $this->storage->attach($observer);
    }

    function detach(SplObserver $observer){ // открепляем наблюдателья от объекта
        $this->storage->detach($observer);
    }

    function notify(){ // вызываем метод update() у всех наблюдателей
        foreach ($this->storage as $obs){
            $obs->update($this);
        }
    }

    function handleLogin($user, $pass, $ip){
        $isValid = false;
        switch (rand(1,3)){ // иммитируем проверку учетных данных пользователя
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isValid = true;
                break;
            case 2;
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isValid = false;
                break;
            case 3;
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isValid = false;
                break;
        }
        $this->notify();
        return $isValid;
    }

    function setStatus($status, $user, $ip){
        $this->status = [$status, $user, $ip];
    }

    function getStatus(){
        return $this->status;
    }
}

class SecurityMonitor extends LoginObserver { // наблюдатель
    function doUpdate(Login $login){
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS){
            // Отправим почту системному администратору
            print __CLASS__." Отправка почты системному администратору<br>";
        }
    }
}

class GeneralLogger extends LoginObserver { // наблюдатель
    function doUpdate(Login $login){
        $status = $login->getStatus();
        // Регистрируем подключение в журнале
        print __CLASS__." Регистрация в системном журнале <br>";
    }
}

class PartnershipTool extends LoginObserver { // наблюдатель
    function doUpdate(Login $login){
        $status = $login->getStatus();
        // отправим cookie файл если адрес соответствует списку
        print __CLASS__." Отправка cookie файла, если адрес соответствует списку <br>";
    }
}

$login = new Login(); // объект за которым будут наблюдать наблюдатели
$securityMonitor = new SecurityMonitor($login); // наблюдатель
$generalLogger = new GeneralLogger($login); // наблюдатель
$partnershipTool = new PartnershipTool($login); // наблюдатель
$login->handleLogin('','','');
