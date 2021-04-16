<?php
require_once('User.php');
require_once ('EmailManager.php');
require_once ('EmailObservers.php');
session_start();


if (isset($_POST['id'])||isset($_POST['name'])||isset($_POST['userName'])||isset($_POST['type'])||isset($_POST['password'])||isset($_POST['password2'])) {

    if($_POST['password']!=$_POST['password2'])
    {
        $_SESSION['errorMessage']="كلمتا السر غير متطابقتين";
        header("Location: ./addUserPage.php");
        exit();
    }
    $User= new User();


    $User->setType($_POST['type']);
    $User->setStrategy($_POST['type']);

    if (!$User->checkRegister($_POST['password']))
    {
        if ($_POST['type']==1) {
            $_SESSION['errorMessage'] = "لا بد أن تكون كلمة السر أكبر من 8 حروف وتحتوي على حرف capital وحرف small ورقم على الأقل";
            header("Location: ./addUserPage.php");
            exit();
        }
        else{
            $_SESSION['errorMessage'] = "لا بد أن تكون كلمة السر أكبر من 6 حروف وتحتوي على حرف capital وحرف small ";
            header("Location: ./addUserPage.php");
            exit();
        }
    }
    $User->setName($_POST['name']);
    $User->setUserName($_POST['userName']);
    $User->setPassword($_POST['password']);
    $User->setId($_POST['id']);
    if (!$User->addToDB()){
        $_SESSION['errorMessage'] = "إسم المستخدم تم إدخاله من قبل";
        header("Location: ./addUserPage.php");
        exit();
    }
    else{

        $added = new AddedAccount($User->getUserName(), $User->getPassword());
        $added->attach(new EmailConfirmer());
        $added->attach(new SMSConfirmer());
        $added->notify();
        $_SESSION['successMessage'] = "تم تسجيل مستخدم جديد بنجاح";
        header("Location: ./showUsersPage.php");
        exit();
    }

}else
{
    $_SESSION['errorMessage']="حدث خطأ";
    header("Location: ./addUserPage.php");
    exit();

}