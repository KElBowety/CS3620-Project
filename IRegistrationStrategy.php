<?php

interface IRegistrationStrategy
{
    public function register($password) : bool;
}