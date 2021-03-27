<?php
require_once "User.php";
require_once "DataBase.php";

class UserUndo implements Undo
{
    private User $u;
    public function __construct(User $u)
    {
        $this->u = $u;
    }
    public function execute(): void
    {
        $query="DELETE FROM users ORDER BY id DESC LIMIT 1";
        DataBase::ExcuteQuery($query);
    }
}