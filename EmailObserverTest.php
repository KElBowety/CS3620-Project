<?php

// this one will work in php action after adding
require_once ('EmailManager.php');
require_once ('EmailObservers.php');

$added = new AddedAccount("abdo_babab", "24564646"); // << the subject
$added->attach(new EmailConfirmer());
$added->attach(new SMSConfirmer());
$added->notify();
echo "Done\n";
?>