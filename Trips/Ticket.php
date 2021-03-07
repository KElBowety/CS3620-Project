<?php


class Ticket extends TripDecorator
{
    private string $location;

    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    function addToDB(): bool
    {
        $id = $this->base->getId();
        $query="INSERT INTO trips (trip_id, cost, description, location) VALUES ('$id','$this->cost','$this->description','$this->location')";
        DataBase::ExcuteQuery($query);
        return true;
    }
}