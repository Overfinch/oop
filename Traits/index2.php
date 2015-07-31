<?php

trait A {
    public function smallTalk(){
        echo "a";
    }

    public function bigTalk(){
        echo "A";
    }
}

trait B {
    public function smallTalk(){
        echo "b";
    }

    public function bigTalk(){
        echo "B";
    }
}

class Talker {
    use A,B{
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
    }
}

class Aliasd_Talker {
    use A,B{
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;
    }
}

$first = new Talker();
$second = new Aliasd_Talker();

$first->smallTalk();
$second->talk();