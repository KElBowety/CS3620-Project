<?php
require_once "Furniture.php";
require_once "Creator.php";
class ConcreteCreator1 extends Creator
{

    public function factoryMethod():  Item
    {
        return new Furniture();
    }
}