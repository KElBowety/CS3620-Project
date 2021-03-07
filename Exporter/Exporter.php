<?php
require_once('../DataBase.php');

class Exporter implements \SplSubject
{
    private \SplObjectStorage $observers;
    private array $postData;

    public function __construct($postData) {
        $this->observers = new \SplObjectStorage();
        $this->postData = $postData;
        $this->getTable();
    }

    public function getTable() {
        $results = DataBase::ExcuteRetreiveQuery("SELECT * FROM ".$this->postData['table']);
        $ids = DataBase::ExcuteRetreiveQuery("SHOW COLUMNS FROM ".$this->postData['table']);
        $_SESSION['results'] = $results;
        $_SESSION['ids'] = $ids;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}