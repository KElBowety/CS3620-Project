<?php

abstract class Human
{
    //template draft
    protected int $id;
    protected string $name;
    final public function templateMethod():void{
        $this->getId();
        $this->addToDB();
        $this->showAllData();
    }
    public function getId(): int
    {
        return $this->id;
    }
}
?>