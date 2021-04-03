<?php
session_start();
require_once ('User.php');
if (!isset($_GET['userId'])) {
    $_SESSION['errorMessage'] = "حدث خطأ";
    header("Location: ./ShowUsersPage.php");
    exit();
}else{
    $uid=$_GET['userId'];
    if (empty($uid)){
        $_SESSION['errorMessage'] = "حدث خطأ";
        header("Location: ./ShowUsersPage.php");
        exit();
    }
    $user= new User();
    $user->setId($uid);
    if ($user->getId()==unserialize($_SESSION["LoginUser"])->getId()){
        $_SESSION['errorMessage'] = "لا يمكن للمستخدم أن يقوم بحذف نفسه";
        header("Location: ./ShowUsersPage.php");
        exit();
    }else{

        if ($user->removeFromDB())
        {
            $_SESSION['successMessage'] = "تم الحذف بنجاح";
            header("Location: ./ShowUsersPage.php");
            exit();
        }else{
            $_SESSION['errorMessage'] = "لم يتم الحذف";
            header("Location: ./ShowUsersPage.php");
            exit();
        }
    }


}