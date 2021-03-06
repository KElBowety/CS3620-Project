<?php


interface IDonnable
{
    public function donate():bool;
    public function getValue():float;
    public function getId():int;

}