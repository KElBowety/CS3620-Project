<?php
include "Subject.php";
include "GoodFood.php";
include "BadFood.php";


$subject = new Subject();

$o1 = new GoodFood ();
$subject->attach($o1);

$o2 = new BadFood();
$subject->attach($o2);

$subject->someBusinessLogic("21/2/2010");
$subject->someBusinessLogic("21/2/2021");

$subject->detach($o2);

$subject->someBusinessLogic("21/2/2011");
?>