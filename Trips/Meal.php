<?php


class Meal extends TripDecorator
{
    private bool $vegetarian;

    public function setVegetarian(bool $vegetarian): void
    {
        $this->vegetarian = $vegetarian;
    }

    public function getVegetarian(): bool
    {
        return $this->vegetarian;
    }

    function addToDB(): bool
    {
        $id = $this->base->getId();
        $query="INSERT INTO meals (trip_id, cost, description, vegetarian) VALUES ('$id','$this->cost','$this->description','$this->vegetarian')";
        DataBase::ExcuteQuery($query);
        return true;
    }
}