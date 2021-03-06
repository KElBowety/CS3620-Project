<?php


class ExportedPageGenerator implements \SplObserver
{
    public function update(SplSubject $subject)
    {
        $_SESSION['exportedPage'] = 1;
        header("location: ./ExportedPage.php");
    }
}