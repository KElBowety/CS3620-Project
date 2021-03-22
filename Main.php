<?php
require_once "Invoker.php";
require_once "SimpleCommand.php";
require_once "ComplexCommand.php";
require_once "Receiver.php";

//https://refactoring.guru/design-patterns/command/php/example#

$invoker = new Invoker();
$invoker->setOnStart(new SimpleCommand("Say Hi!"));
$receiver = new Receiver();
$invoker->setOnFinish(new ComplexCommand($receiver, "Send email", "Save report"));

$invoker->doSomethingImportant();
