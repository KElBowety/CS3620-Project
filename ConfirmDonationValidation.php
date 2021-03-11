<?php

require_once('Donation.php');
require_once ('Clothes.php');
require_once ('Food.php');
require_once ('Furniture.php');
require_once ('Financial.php');
require_once ('DonationDetails.php');
require_once ('TempDonor.php');



session_start();

if(isset($_POST['idNumber'])&& isset($_POST['phone'])&&isset($_POST['name'])){
    $Donation=new Donation();

//    if(!$Donation->setId($_POST['id'])){
//        $_SESSION['errorMessage'] = "خطأ فى الرقم القومي";
//        header("Location: ./addDonationPage.php");
//        exit();
//    }
//    if(!$Donation->setDate($_POST['date'])){
//        $_SESSION['errorMessage'] = "خطأ فى الصلاحية";
//        header("Location: ./addDonationPage.php");
//        exit();
//    }
//    if(!$Donation->setDate($_POST['value'])){
//        $_SESSION['errorMessage'] = "خطأ فى القيمة";
//        header("Location: ./addDonationPage.php");
//        exit();
//    }
//    if (!$Donation->addToDB()){
//        $_SESSION['errorMessage'] = "الرقم القومي مسجل من قبل";
//        header("Location: ./addDonationPage.php");
//        exit();
//    }else{
//        $_SESSION['successMessage'] = "تم تسجيل تبرع جديد بنجاح";
//        header("Location: ./showDonorsPage.php");
//        exit();
//    }
    $myarr=unserialize($_SESSION['donations']);
    $total=0;
    $donationDetails=array();
    for ($i=0;$i<count($myarr);$i++)
    {

        $obj=unserialize($myarr[$i]);
        $total=$total+$obj->getValue();
        $dd= new DonationDetails();
        $dd->setDonnable($obj);
        $donationDetails[]=$dd;
    }
    print_r($donationDetails);
    $Donation->setValue($total);
    $Donation->setDate(date('Y-m-d H:i:s'));
    $donor= new TempDonor();
    $donor->setName($_POST['name']);
    $donor->setPhoneNumber($_POST['phone']);
    $donor->setId($_POST['idNumber']);
    print_r($donor);
    $donor->addToDB();
    echo $total;
    $Donation->setDonorId($donor->getId());
    $Donation->donate($donationDetails);
    unset($_SESSION['donations']);
    header("Location: ./addDonationPage.php");
    exit();

}else
{
    $_SESSION['errorMessage']="حدث خطأ";
    header("Location: ./addDonationPage.php");
    exit();

}
