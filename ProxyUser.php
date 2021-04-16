<?php

require_once ('User.php');
require_once ('ProxyUserInterface.php');
class ProxyUser implements ProxyUserInterface
{

    protected $User;
    public function getUsersFiltered() {
        if (null === $this->User) {
            $this->User= new User();
        }
        return $this->User->getUsersFiltered();
    }
}