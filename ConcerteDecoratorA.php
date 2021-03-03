<?php

class ConcerteDecoratorA extends Decorator{
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . parent::operation() . ")";
    }
}
