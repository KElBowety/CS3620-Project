<?php
require_once('User.php');
session_start();


if (isset($_POST['userName']) && isset($_POST['password'])) {

    $u = new User();
    $u->setUserName($_POST['userName']);
    $u->setPassword($_POST['password']);
    $logResult = $u->logIn();
    if ($logResult) {
        $_SESSION["LoginUser"] = $u;
        $_SESSION["successMessage"] = "تم تسجيل الدخول بنجاح";
        header("Location: ./AdminPage.php");
        exit();
    } else {
        $_SESSION["errorMessage"] = "خطأ فى إسم المستخدم أو كلمة السر";
        header("Location: ./LoginPage.php");
        exit();
    }
}else
{
    $_SESSION["errorMessage"] = "قم بتسجيل الدخول";
    header("Location: ./LoginPage.php");
    exit();
}