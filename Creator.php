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

    public function someOperation()
    {
        $Item = $this->factoryMethod();
        // Now, use the product.
        $result = "Creator: The same creator's code has just worked with " ;
           // $Item->getValue();

        return $Item;
    }
}