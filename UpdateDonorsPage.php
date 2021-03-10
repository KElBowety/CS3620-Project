<?php

require_once('DataBase.php');

session_start();

if (!isset($_SESSION["LoginUser"])) {
    header("Location: ./LoginPage.php");
    exit();
}
$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> تعديل الإشتراك
    <?php
    echo $pageContents[2][2];
    ?>




</head>

<body dir="rtl">

    <?php
    echo $pageContents[3][2];
    ?>

    <main style="background-color: black;">

        <?php
        echo $pageContents[4][2];
        ?>

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
        <h2 class="text-white text-center" style="padding-top: 10px "> تعديل مشترك </h2>
        <form style="padding-top: 5%; padding-bottom: 5%" action="./UpdateDonorsValidation.php" method="post">
            <div class=" d-flex justify-content-center" style="padding: 2%">
                <div class="container">
                    <div class="row">
                        <label class="label col-4">
                            <h4 class="text-white">رقم البطاقة:</h4>
                        </label>
                        <input type="text" class="col-6" name="id" id="id" style="width: 400px" required />
                    </div>
                </div>
            </div>
            <div class=" d-flex justify-content-center" style="padding: 2%">
                <div class="container">
                    <div class="row">
                        <label class="label col-4">
                            <h4 class="text-white">نوع الإشتراك:</h4>
                        </label>
                        <select name="subscriptionType" id="subscriptionType" style="width: 100px" required>
                            <option value=1>شهري</option>
                            <option value=2>سنوي</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class=" d-flex justify-content-center" style="padding: 2%">
                <div class="container">
                    <div class="row">
                        <label class="label col-4">
                            <h4 class="text-white">قيمة الإشتراك:</h4>
                        </label>
                        <input type="Number" class="col-6" name="subscriptionValue" id="subscriptionValue" style="width: 400px" required />
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="padding-top: 60px">
                <!--Grid column-->
                <button class="btn btn-primary" name="submit" type="submit" value="Submit">تعديل الإشتراك</button>
                <!--Grid column-->
            </div>
        </form>
    </main>
    <?php
    echo $pageContents[0][2];
    ?>

</body>

</html>