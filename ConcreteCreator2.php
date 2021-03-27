<?php
require_once "Food.php";

class ConcreteCreator2 extends Creator
{

    public function factoryMethod():  Item
    {
        return new Food();
    }
}