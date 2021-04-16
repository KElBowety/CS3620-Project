<?php

require_once "State.php";
require_once "ConcerteStateA.php";
class ConcerteStateB extends State
{

    public function handle1(): void
    {
        echo "ConcreteStateB handles request1.\n";
    }

    public function handle2(): void
    {
        echo "ConcreteStateB handles request2.\n";
        echo "ConcreteStateB wants to change the state of the context.\n";
        $this->context->transitionTo(new ConcerteStateA());
    }
}