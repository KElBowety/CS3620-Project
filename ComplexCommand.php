<?php


class ComplexCommand implements Command
{

    private $receiver;

    private $a;

    private $b;

    public function __construct(Receiver $receiver, $a, $b)
    {
        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $b;
    }

    public function execute()
    {
        echo "ComplexCommand: Complex stuff should be done by a receiver object.\n";
        $this->receiver->doSomething($this->a);
        $this->receiver->doSomethingElse($this->b);
    }
}