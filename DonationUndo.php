<?php
require_once "DonorWithAccount.php";
require_once "Undo.php";

class DonationUndo implements Undo
{
    private DonorWithAccount $d;

    public function __construct(DonorWithAccount $d)
    {
        $this->d = $d;
    }
    public function execute(): void
    {
        $query="DELETE FROM donorWithAccount ORDER BY id DESC LIMIT 1";
        DataBase::ExcuteQuery($query);
        $query="DELETE FROM human ORDER BY id DESC LIMIT 1";
        DataBase::ExcuteQuery($query);
    }
}