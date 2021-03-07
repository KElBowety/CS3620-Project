<?php
require_once 'IRegistrationStrategy.php';
require_once('DataBase.php');

class AccountantRegistrationStrategy implements IRegistrationStrategy
{
    public function register($postData): bool
    {
        $password = $postData['password'];
        $password2 = $postData['password2'];

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);

        if($uppercase && $lowercase && strlen($password) >= 6 && strcmp($password, $password2)) {
            return true;
        }
        else {
            return false;
        }
    }
}