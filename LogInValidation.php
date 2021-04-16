<?php
require_once('User.php');
require_once "Context.php";
require_once "LoginState.php";
session_start();
$context = new Context(new LoginState());
$context->request2();

if (isset($_POST['userName']) && isset($_POST['password'])) {

    $u = new User();
    $u->setUserName($_POST['userName']);
    $u->setPassword($_POST['password']);
    $logResult = $u->logIn();
    if ($logResult) {
        $_SESSION["LoginUser"] = serialize($u);
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
