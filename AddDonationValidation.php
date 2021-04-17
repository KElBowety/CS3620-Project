<?php

include_once 'ConcreteCreator1.php';
include_once 'ConcreteCreator2.php';
include_once 'ConcreteCreator3.php';

session_start();

if(!isset($_SESSION['donations'])) {
    $arr=array();
    $arr=serialize($arr);
    $_SESSION['donations'] = $arr;
}

$obj = NULL;

function creation(Creator $creator)
{
    $Item=$creator->someOperation();
    return $Item;
}

if(isset($_POST)) {
    if ($_POST['donationType'] > 0 && $_POST['donationType'] < 4 && $_POST['value'] > 0 && $_POST['quantity'] > 0) {
        switch ($_POST['donationType']) {
            case 1:
                $obj = creation(new ConcreteCreator1());
                $obj->setSize('M');
                break;
            case 2:
                $obj = creation(new ConcreteCreator2());
                $obj->setValidationPeriod(15);
                break;
            case 3:
                $obj = creation(new ConcreteCreator3());
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
