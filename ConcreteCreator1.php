<?php


class ConcreteCreator1 extends Creator
{

    public function factoryMethod()
    {
        return new ConcreteProduct1();
    }


}