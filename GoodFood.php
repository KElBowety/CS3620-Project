<?php


class GoodFood implements \SplObserver
{

    public function update(SplSubject $subject)
    {
        if($subject->state>0){
            echo "Food good\n";
            echo"\n";
        }
    }
}