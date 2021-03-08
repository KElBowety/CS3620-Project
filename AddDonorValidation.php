<?php
require_once('DonorWithAccount.php');
session_start();


if (isset($_POST['id'])||isset($_POST['name'])||isset($_POST['age'])||isset($_POST['address'])||isset($_POST['subscriptionType'])||isset($_POST['subscriptionValue'])) {

    $Donor= new DonorWithAccount();



    if(!$Donor->setName($_POST['name'])){
        $_SESSION['errorMessage'] = "خطأ فى الإسم";
        header("Location: ./addDonorPage.php");
        exit();
    }
    if(!$Donor->setId($_POST['id'])){
        $_SESSION['errorMessage'] = "خطأ فى الرقم القومي";
        header("Location: ./addDonorPage.php");
        exit();
    }
    if(!$Donor->setAddress($_POST['address'])){
        $_SESSION['errorMessage'] = "خطأ فى العنوان";
        header("Location: ./addDonorPage.php");
        exit();
    }
    if(!$Donor->setAge($_POST['age'])){
        $_SESSION['errorMessage'] = "خطأ فى العمر";
        header("Location: ./addDonorPage.php");
        exit();
    }
    if(!$Donor->setSubscriptionType($_POST['subscriptionType'])){
        $_SESSION['errorMessage'] = "خطأ فى نوع الإشتراك";
        header("Location: ./addDonorPage.php");
        exit();
    }
    if(!$Donor->setSubscriptionAmount($_POST['subscriptionValue'])){
        $_SESSION['errorMessage'] = "خطأ فى قيمة الإشتراك";
        header("Location: ./addDonorPage.php");
        exit();
    }

    if (!$Donor->addToDB()){
        $_SESSION['errorMessage'] = "الرقم القومي مسجل من قبل";
        header("Location: ./addDonorPage.php");
        exit();
    }else{
        $_SESSION['successMessage'] = "تم تسجيل إشتراك جديد بنجاح";
        header("Location: ./showDonorsPage.php");
        exit();
    }

}else
{
    $_SESSION['errorMessage']="حدث خطأ";
    header("Location: ./addDonorPage.php");
    exit();

}