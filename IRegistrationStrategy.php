<?php

interface IRegistrationStrategy
{
    public function register($postData) : bool;
}