<?php
require_once 'IRegistrationStrategy.php';
require_once('DataBase.php');

class AdminRegistrationStrategy implements IRegistrationStrategy
{
    public function register($postData) : bool
    {
        $password = $postData['password'];
        $password2 = $postData['password2'];

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if($uppercase && $lowercase && $number && strlen($password) >= 8 && strcmp($password, $password2)) {
            return true;
        }
        else {
            return false;
        }
    }
}