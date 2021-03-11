<?php

include_once 'Clothes.php';
include_once 'Food.php';
include_once 'Furniture.php';

session_start();

if(!isset($_SESSION['donations'])) {
    $arr=array();
    $arr=serialize($arr);
    $_SESSION['donations'] = $arr;
}

$obj = NULL;

if(isset($_POST)) {
    if ($_POST['donationType'] > 0 && $_POST['donationType'] < 4 && $_POST['value'] > 0 && $_POST['quantity'] > 0) {
        switch ($_POST['donationType']) {
            case 1:
                $obj = new Clothes();
                $obj->setSize('M');
                break;
            case 2:
                $obj = new Food();
                $obj->setValidationPeriod(15);
                break;
            case 3:
                $obj = new Furniture();
                $obj->setIsNew(true);
                break;
        }

        $obj->setName($_POST['name']);
        $obj->setItemValue($_POST['value']);
        $obj->setQuantity($_POST['quantity']);
        $obj->setEntryDate(date('Y-m-d H:i:s'));
        $obj=serialize($obj);
        $arr=unserialize($_SESSION['donations']);
        array_push($arr, $obj);
        $arr=serialize($arr);
        $_SESSION['donations']=$arr;
        $_SESSION['successMessage'] = "تمت الإضافة بنجاح";
        header("Location: ./addDonationPage.php");
        exit();
    }
    else {
        $_SESSION['donationError'] = true;
        $_SESSION['errorMessage'] = "قيمة غير صالحة";
        header("Location: ./addDonationPage.php");
        exit();
    }
}else{
    echo 'error';
}
