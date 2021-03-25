<?php
require_once "User.php";

class UserUndo implements Undo
{
    private User $u;
    public function __construct(User $u)
    {
        $this->u = $u;
    }
    public function execute(): void
    {
        $this->u->removeFromDB();
    }
}