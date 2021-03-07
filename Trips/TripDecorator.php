<?php


abstract class TripDecorator extends TripBase
{
    protected TripBase $base;

    public function calculateCost(): float
    {
        return $this->cost + $this->base->calculateCost();
    }

    public function getDescription(): string
    {
        return $this->base->getDescription() . " + " . $this->description;
    }
}