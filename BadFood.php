<?php


class BadFood implements \SplObserver
{

    public function update(SplSubject $subject)
    {
        if($subject->state==0){
            echo "Food bad\n";
            echo"\n";
        }
    }
}