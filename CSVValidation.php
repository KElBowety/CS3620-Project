<?php
require_once "CsvIterator.php";
require_once('User.php');
session_start();

if(isset($_POST)){
    $User= new User();
    $filename=($_POST['file']);
    $csv = new CsvIterator(__DIR__ . '/'.$filename.'.csv');
    $csv->next();
    foreach ($csv as $key => $row) {
        $key=$csv->key();
        if($key=='{0}'){
            $User->setId($row);
        }elseif ($key=='{1}'){
            $User->setName($row);
        }elseif ($key=='{2}'){
            $User->setUserName($row);
        }elseif ($key=='{3}'){
            $User->setType($row);
        }elseif ($key=='{4}'){
            $User->setPassword($row);
        }
        $User->setType($_POST['type']);
        $User->setStrategy($_POST['type']);
        if (!$User->addToDB()){
            $_SESSION['errorMessage'] = "إسم المستخدم أو الرقم القومي تم إدخالهم من قبل";
            header("Location: ./UserController.php");
            exit();
        }
        else{

            $added = new AddedAccount($User->getUserName(), $User->getPassword());
            $added->attach(new EmailConfirmer());
            $added->attach(new SMSConfirmer());
            $added->notify();
            $_SESSION['successMessage'] = "تم تسجيل مستخدم جديد بنجاح";
            header("Location: ./UserController.php");
            exit();
        }

    }



}else
{
    $_SESSION['errorMessage']="حدث خطأ";
    header("Location: ./addUserPage.php");
    exit();

}
