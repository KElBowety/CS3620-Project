<?php
require_once "Food.php";
require_once "Creator.php";
class ConcreteCreator2 extends Creator
{

    public function factoryMethod():  Item
    {
        return new Food();
    }
}