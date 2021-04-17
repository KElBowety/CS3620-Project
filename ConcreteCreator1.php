<?php
require_once "Clothes.php";
require_once "Creator.php";
class ConcreteCreator1 extends Creator
{

    public function factoryMethod():  Item
    {
        return new Clothes();
    }
}