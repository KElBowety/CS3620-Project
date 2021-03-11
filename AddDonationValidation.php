<?php

require_once 'Clothes.php';
require_once 'Food.php';
require_once 'Furniture.php';

session_start();

if(!isset($_SESSION['donations'])) {
    $_SESSION['donations'] = array();
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
        $obj->setEntryDate(date(DATE_RFC2822));

        array_push($_SESSION['donations'], $obj);
        print_r( $obj);
    }
    else {
        $_SESSION['donationError'] = true;
    }
}
