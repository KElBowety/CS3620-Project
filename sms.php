<?php
// the message
$msg = "Observer email implementation using Email\n Test";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("karim.elbowety@uofcanada.edu.eg","Code example because why not",$msg);
mail("abdelrahman.ghanam@uofcanada.edu.eg","Code example because why not",$msg);
echo "sent";
?>