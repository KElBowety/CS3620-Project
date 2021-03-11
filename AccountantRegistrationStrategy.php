<?php
require_once 'IRegistrationStrategy.php';

class AccountantRegistrationStrategy implements IRegistrationStrategy
{
    public function register($password): bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);

        if($uppercase && $lowercase && strlen($password) >= 6) {
            return true;
        }
        else {
            return false;
        }
    }
}