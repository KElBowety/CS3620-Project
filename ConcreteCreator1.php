<?php
require_once "Furniture.php";

class ConcreteCreator1 extends Creator
{

    public function factoryMethod():  Item
    {
        return new Furniture();
    }
}