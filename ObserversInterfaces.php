<?php


interface SplSubject {
    public function attach (SplObserver $observer);
    public function detach (SplObserver $observer);
    public function notify ();
}

interface SplObserver {
    public function update (SplSubject $subject);
}

?>


