<?php

require_once('DonorWithAccount.php');
session_start();

if (isset($_POST['id']) || isset($_POST['subscriptionType']) || isset(($_POST['subscriptionValue']))) {
    $Donor = new DonorWithAccount();

    if (!$Donor->setId($_POST['id'])) {
        $_SESSION['errorMessage'] = "خطأ فى الرقم القومي";
        header("Location: ./UpdateDonorsPage.php");
        exit();
    }
    if (!$Donor->setSubscriptionType($_POST['subscriptionType'])) {
        $_SESSION['errorMessage'] = "خطأ فى نوع الإشتراك";
        header("Location: ./UpdateDonorsPage.php");
        exit();
    }
    if (!$Donor->setSubscriptionAmount($_POST['subscriptionValue'])) {
        $_SESSION['errorMessage'] = "خطأ فى قيمة الإشتراك";
        header("Location: ./UpdateDonorsPage.php");
        exit();
    }
    if (!$Donor->updateInDB()) {
        $_SESSION['errorMessage'] = "الرقم القومي ليس مسجل";
        header("Location: ./UpdateDonorsPage.php");
        exit();
    } else {
        $_SESSION['successMessage'] = "تم تعديل الاشتراك بنجاح";
        header("Location: ./ShowDonorsPage.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "حدث خطأ";
    header("Location: ./UpdateDonorsPage.php");
    exit();
}
