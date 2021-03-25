<?php
require_once "DonorWithAccount.php";

class DonationUndo implements Undo
{
    private DonorWithAccount $d;

    public function __construct(DonorWithAccount $d)
    {
        $this->d = $d;
    }
    public function execute(): void
    {
        $this->d->removeFromDB();
    }
}