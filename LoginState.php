<?php

require_once "State.php";
require_once "LogOutState.php";

class LoginState extends State
{

    public function handle1(): void
    {

        echo "User logging out\n";
        $this->context->transitionTo(new LogOutState());
    }

    public function handle2(): void
    {
        echo "User logs in.\n";
    }
}