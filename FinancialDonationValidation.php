<?php

require_once('Donation.php');
session_start();

if (isset($_POST['value']) && isset($_POST['date'])) {

    $d = new Donation();
    $logResult = $d->addToDB();
    if ($logResult) {
        //$_SESSION["LoginUser"] = $u;
        $_SESSION["successMessage"] = "تم اضافة التبرع";
        $i++;
        header("Location: ./AdminPage.php");
        exit();
    } else {
        $_SESSION["errorMessage"] = "البيانات ليست كاملة";
        header("Location: ./addDonationPage.php");
        exit();
    }
}
