<?php

class Checkout{ // final class Chrckout - в таком случае нельзя было бы наследовать финальный класс
    final function totalize(){ // финальный метод нельзя наследовать

    }
}

class IllegalCheckout extends Checkout{
    //function totalize(){}
}