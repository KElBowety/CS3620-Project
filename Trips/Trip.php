<?php


class Trip extends TripBase
{
    private string $title;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function calculateCost(): float
    {
        return $this->cost;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    function addToDB(): bool
    {
        $query="INSERT INTO trips (title, description, cost) VALUES ('$this->title','$this->description',$this->cost)";
        DataBase::ExcuteQuery($query);
        return true;
    }
}