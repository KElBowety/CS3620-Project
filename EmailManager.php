<?php



class AddedAccount implements SplSubject
{
    protected $observers = [];
    public $userName;
    public $password;

    public function __construct($userName, $password)
    {
        $this->userName= $userName;
        $this->password = $password;
    }

    public function attach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        $this->observers[$key] = $observer;
        return $this;
    }

    public function detach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        unset($this->observers[$key]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
?>