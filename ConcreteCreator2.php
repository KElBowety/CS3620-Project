<?php


class ConcreteCreator2 extends Creator
{

    public function factoryMethod()
    {
        return new ConcreteProduct2();
    }
}