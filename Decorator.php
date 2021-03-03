<?php

class Decorator implements Component{
    private $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }
    public function operation(): string
    {
        return $this->component->operation();
    }
}
