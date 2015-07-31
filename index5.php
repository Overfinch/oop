<?php

interface IntFace {
    function test1();
    function test2();
    function test3();
}

interface IntFace2 {
    function test4();
    function test5();
    function test6();
}

interface IntFace3 {
    function test7();
    function test8();
    function test9();
}

class ParentEx {
    function parentInfo(){
        echo 'method parentInfo';
    }
}

class Ex extends ParentEx implements IntFace,IntFace2,IntFace3 {
    function test1() {
        echo 'method test1';
    }
    function test2() {
        echo 'method test1';
    }
    function test3() {
        echo 'method test1';
    }
    function test4() {
        echo 'method test1';
    }
    function test5() {
        echo 'method test1';
    }
    function test6() {
        echo 'method test1';
    }
    function test7() {
        echo 'method test1';
    }
    function test8() {
        echo 'method test1';
    }
    function test9() {
        echo 'method test1';
    }
}

$object = new Ex();
$object->parentInfo();