<?php
require_once ('../DataBase.php');

abstract class TripBase implements IAddToDB
{
    protected int $id;
    protected float $cost;
    protected string $description;

    public function __constructor(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function setCost(float $cost) : void
    {
        if($cost > 0)
        {
            $this->cost = $cost;
        }
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public abstract function addToDB(): bool;
    public abstract function getDescription(): string;
    public abstract function calculateCost() : float;
}