<?php


interface Undo
{
    public function execute(): void;
}