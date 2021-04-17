<?php
require_once "Creator.php";
require_once "Furniture.php";
class ConcreteCreator3 extends Creator
{

    public function factoryMethod(): Item
    {
        return new Furniture();
    }
}