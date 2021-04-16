<?php
require_once "Creator.php";
require_once "Clothes.php";
class ConcreteCreator3 extends Creator
{

    public function factoryMethod(): Item
    {
        return new Clothes();
    }
}