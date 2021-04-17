<?php
require_once "Financial.php";

class DetailsAdapter
{
    private $details;

    public function __construct(Financial $dd){
        $this->details=$dd;
    }
    public function getIDandValue(){
        return $this->details->getId().'and the value is '.$this->details->getValue();
    }
}