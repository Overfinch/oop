<?php

// Реализация шаблона Factory Method

abstract class Text {
    abstract function write();
}

class RedText extends Text {
    function write(){
        return "Красный текст <br>";
    }
}

class BlueText extends Text {
    function write(){
        return "Синий текст <br>";
    }
}

abstract class Maker{
    abstract function getText();
    abstract function getHeader();
    abstract function getFooter();
}

class RedMaker extends Maker {
    function getText(){
        return new RedText();
    }

    function getHeader(){
        return "Красный хедер <br>";
    }

    function getFooter(){
        return "Красный футер <br>";
    }
}

class BlueMaker extends Maker {
    function getText(){
        return new BlueText();
    }

    function getHeader(){
        return "Синий хедер <br>";
    }

    function getFooter(){
        return "Синий футер <br>";
    }
}

$red = new RedMaker();  // тут мы всегда будем получать объект абстрактного класса Maker или его дочернего класса
                        // в данном случае "RedMaker", если мы захотим добавить например класс "BlueMaker" и "BlueText"
                        // то мы их просто добавим, а в клиентском коде ничего не придется менять
print $red->getHeader();
print $red->getFooter();
print $red->getText()->write();