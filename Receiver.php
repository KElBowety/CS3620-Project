<?php


class Receiver
{
    public function doSomething($a){
        echo "Receiver: Working on (" . $a . ".)\n";
    }
    public function doSomethingElse($b)
    {
        echo "Receiver: Also working on (" . $b . ".)\n";
    }

}