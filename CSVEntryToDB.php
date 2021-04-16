<?php
require_once('DataBase.php');
include "User.php";
session_start();
$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>أضافة من أكسل الي قاعدة البيانات</head>
<body dir="rtl">
<main style="background-color: black;">
    <?php
    if (isset($_SESSION["errorMessage"])) {
        ?>
        <div class="alert alert-danger justify-content-end d-flex" role="alert" data-mdb-color="danger" dir="rtl">
            <?php echo $_SESSION["errorMessage"]; ?>
        </div>
        <?php
        unset($_SESSION["errorMessage"]);
    }
    if (isset($_SESSION["successMessage"])) {
        ?>
        <div class="alert alert-success justify-content-end d-flex" role="alert" data-mdb-color="danger" dir="rtl">
            <?php echo $_SESSION["successMessage"]; ?>
        </div>
        <?php
        unset($_SESSION["successMessage"]);
    }
    ?>
    <h1 class="text-white text-center"> إضافة اسم ملف الأكسل </h1>
    <form action="./CSVValidation.php" method="post">
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="row">
                <label class="label col-4">
                        <h4 class="text-white">إسم المستخدم</h4>
                </label>
                <input type="text" class="col-6" name="file" id="file" style="width: 400px" required />
            </div>
        </div>



