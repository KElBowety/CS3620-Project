<?php
require_once "Context.php";
require_once "LogOutState.php";
session_start();
$context = new Context(new LogOutState());
$context->request1();
if(isset( $_SESSION["LoginUser"])) {

    unset( $_SESSION["LoginUser"]);
    session_destroy();
    $_SESSION["successMessage"] = " تم تسجيل الخروج الخروج بنجاح ";
    header("Location: ./LoginPage.php");
}
else{
    header("Location: ./LoginPage.php");
}
?>
