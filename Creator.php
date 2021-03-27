<?php

require_once "Item.php";
abstract class Creator
{
    abstract public function factoryMethod(): Item;
    public function someDonation():string{
        $donation=$this->factoryMethod();
        $result="Donating " . $donation->donate();
        return $result;
    }
}