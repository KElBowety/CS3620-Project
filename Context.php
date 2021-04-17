<?php


class Context
{
    private $state;

    public function __construct(State $state){
        $this->transitionTo($state);
    }
    public function transitionTo(State $state){
        echo "Context: Transition to ". get_class($state)."\n";
        $this->state=$state;
        $this->state->setContext($this);
    }
    public function request1():void{
        $this->state->handle1();
    }
    public function request2():void{
        $this->state->handle2();
    }
}