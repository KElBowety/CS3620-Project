<?php
include_once ('Financial.php');
include_once('DetailsAdapter.php');
session_start();

if(!isset($_SESSION['donations'])) {
    $arr=array();
    $arr=serialize($arr);
    $_SESSION['donations'] = $arr;
}

if(isset($_POST)) {
    if (isset($_POST['value'])){
        $financial= new Financial();
        $Adapter=new DetailsAdapter($financial);

        if (!$financial->setAmount($_POST['value'])){
            $_SESSION['errorMessage'] = "قيمة غير صالحة";
            header("Location: ./addDonationPage.php");
            exit();
        }
        $financial=serialize($financial);
        $adpat=$Adapter->getIDandValue();
        $arr=unserialize($_SESSION['donations']);
        array_push($arr, $financial);
        $arr=serialize($arr);
        $_SESSION['donations']=$arr;
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
