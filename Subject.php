<?php


class Subject implements \SplSubject
{
    public $state;
    private $observers;

    public function __construct(){
        $this->observers=new \SplObjectStorage();

    }

    public function attach(SplObserver $observer)
    {
        echo "Subject: Attached an observer.\n";
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {

        $this->observers->detach($observer);
        echo "Subject: Detached an observer.\n";
    }

    public function notify(): void
    {
        
        echo "Subject: Notifying observers....\n";
        foreach ($this->observers as $observer){
            $observer->update($this);
        }
    }
    public function someBusinessLogic($date):void{
        echo "\nSubject: calc expiry date\n";
        $year=substr($date,-4);
        $this->state=2021-(int)$year;

        echo "Subject: My state has just changed to: {$this->state}\n";
        $this->notify();
    }

}
