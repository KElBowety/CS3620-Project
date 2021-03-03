<?php

class ConcerteDecoratorB extends Decorator{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . parent::operation() . ")";
    }
}
