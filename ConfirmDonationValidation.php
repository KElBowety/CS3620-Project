<?php

require_once('Donation.php');

session_start();

if(isset($_POST['id'])|| isset($_POST['date'])||isset($_POST['value'])){
    $Donation=new Donation();

    if(!$Donation->setId($_POST['id'])){
        $_SESSION['errorMessage'] = "خطأ فى الرقم القومي";
        header("Location: ./addDonationPage.php");
        exit();
    }
    if(!$Donation->setDate($_POST['date'])){
        $_SESSION['errorMessage'] = "خطأ فى الصلاحية";
        header("Location: ./addDonationPage.php");
        exit();
    }
    if(!$Donation->setDate($_POST['value'])){
        $_SESSION['errorMessage'] = "خطأ فى القيمة";
        header("Location: ./addDonationPage.php");
        exit();
    }
    if (!$Donation->addToDB()){
        $_SESSION['errorMessage'] = "الرقم القومي مسجل من قبل";
        header("Location: ./addDonationPage.php");
        exit();
    }else{
        $_SESSION['successMessage'] = "تم تسجيل تبرع جديد بنجاح";
        header("Location: ./showDonorsPage.php");
        exit();
    }
}else
{
    $_SESSION['errorMessage']="حدث خطأ";
    header("Location: ./addDonationPage.php");
    exit();

}
