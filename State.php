<?php


abstract class State
{
    protected $context;
    public function setContext(Context $context){
        $this->context=$context;
    }
    abstract public function handle1():void;
    abstract public function handle2():void;

}