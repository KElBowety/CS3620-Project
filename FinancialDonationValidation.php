<?php
require_once ('Financial.php');
session_start();

if(!isset($_SESSION['donations'])) {
    $_SESSION['donations'] = array();
}

if(isset($_POST)) {
    if (isset($_POST['value'])){
        $financial= new Financial();
        if (!$financial->setAmount($_POST['value'])){
            $_SESSION['errorMessage'] = "قيمة غير صالحة";
            header("Location: ./addDonationPage.php");
            exit();
        }
        $financial=serialize($financial);

        array_push($_SESSION['donations'], $financial);
        $_SESSION['successMessage'] = "تم تسجيل التبرع بنجاح";
        header("Location: ./addDonationPage.php");
        exit();
    }else{
        $_SESSION['errorMessage'] = "حدث خطأ ";
        header("Location: ./addDonationPage.php");
        exit();
    }


}else{

    $_SESSION['errorMessage'] = "حدث خطأ ";
    header("Location: ./addDonationPage.php");
    exit();
}
