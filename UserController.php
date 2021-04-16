<?php

require_once('DataBase.php');
require_once('User.php');
require_once('UserView.php');
session_start();

if(!isset($_SESSION["LoginUser"]))
{
    header("Location: ./LoginPage.php");
    exit();
}

$pageContents=DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
$TypeToArray= array('1'=>'أدمن','2'=>'محاسب');
$u=$_SESSION["LoginUser"];
$users = User::showAllData();
$view = new UserView($pageContents, $users, $TypeToArray);

$view->showHeader();
$view->showUsers();
$view->showAddUser();
$view->showFooter();
