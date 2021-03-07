<?php
if(isset( $_SESSION["LoginUser"])) {

    unset( $_SESSION["LoginUser"]);
    $_SESSION["successMessage"] = " تم تسجيل الخروج الخروج بنجاح ";
    header("Location: ./LoginPage.php");
}
else{
    header("Location: ./LoginPage.php");
}
?>
