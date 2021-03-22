<?php


class Invoker
{
    private $onStart;

    private $onFinish;

    public function setOnStart(Command $command)
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command)
    {
        $this->onFinish = $command;
    }

    public function doSomethingImportant()
    {
        echo "Invoker: Does anybody want something done before I begin?\n";
        if ($this->onStart instanceof Command) {
            $this->onStart->execute();
        }

        echo "Invoker: ...doing something really important...\n";

        echo "Invoker: Does anybody want something done after I finish?\n";
        if ($this->onFinish instanceof Command) {
            $this->onFinish->execute();
        }
    }


}