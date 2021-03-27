<?php


class ConcreteCreator3 extends Creator
{

    public function factoryMethod(): Item
    {
        return new Clothes();
    }
}