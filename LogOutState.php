<?php
require_once "State.php";
require_once "LoginState.php";
class LogOutState extends State
{
    public function handle1(): void
    {
        echo "User logged out.\n";
    }

    public function handle2(): void
    {
        echo "User wants to log back in.\n";
        $this->context->transitionTo(new ConcerteStateA());
    }
}