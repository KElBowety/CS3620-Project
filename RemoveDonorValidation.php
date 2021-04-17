<?php
session_start();
require_once ('DonorWithAccount.php');
if (!isset($_GET['donorId'])) {
    $_SESSION['errorMessage'] = "حدث خطأ";
    header("Location: ./showDonorsPage.php");
    exit();
}else{
    $uid=$_GET['donorId'];
    if (empty($uid)){
        $_SESSION['errorMessage'] = "حدث خطأ";
        header("Location: ./showDonorsPage.php");
        exit();
    }
    $user= new DonorWithAccount();
    $user->setId($uid);
        if ($user->removeFromDB())
        {
            $_SESSION['successMessage'] = "تم الحذف بنجاح";
            header("Location: ./showDonorsPage.php");
            exit();
        }else{
            $_SESSION['errorMessage'] = "لم يتم الحذف";
            header("Location: ./showDonorsPage.php");
            exit();
        }

}