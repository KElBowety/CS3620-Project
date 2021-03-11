<?php
require_once 'IRegistrationStrategy.php';

class AdminRegistrationStrategy implements IRegistrationStrategy
{
    public function register($password) : bool
    {

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if($uppercase && $lowercase && $number && strlen($password) >= 8) {
            return true;
        }
        else {
            return false;
        }
    }
}