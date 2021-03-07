
<?php
require_once('DataBase.php');
session_start();
//if(!isset($_SESSION["LoginUser"]))
//{
//    header("Location: ./LoginPage.php");
//    exit();
//}

$pageContents=DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> إضافة إشتراك <?php
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
    if(isset($_SESSION["errorMessage"])) {
        ?>
        <div class="alert alert-danger justify-content-end d-flex" role="alert" data-mdb-color="danger" dir="rtl">
            <?php  echo $_SESSION["errorMessage"]; ?>
        </div>
        <?php
        unset($_SESSION["errorMessage"]);
    }
    if(isset($_SESSION["successMessage"])) {
        ?>
        <div class="alert alert-success justify-content-end d-flex" role="alert" data-mdb-color="danger" dir="rtl">
            <?php  echo $_SESSION["successMessage"]; ?>
        </div>
        <?php
        unset($_SESSION["successMessage"]);
    }
    ?>









    <form  style="padding-top: 15%; padding-bottom: 15%" action="./AddDonorValidation.php" method="post">
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">الإسم:</h4></label>
                <input type="text" class="col-6"  name="userName" id="userName" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">السن:</h4></label>
                <input type="Number" class="col-6"  name="Age" id="Age" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">العنوان:</h4></label>
                <input type="text" class="col-6"  name="address" id="address" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">رقم البطاقة:</h4></label>
                <input type="text" class="col-6"  name="idNumber" id="idNumber" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">نوع الإشتراك:</h4></label>
                <input type="text" class="col-6"  name="subscriptionTyp" id="subscriptionType" style="width: 400px"  required />
            </div>
            </div>
        </div>        <div class=" d-flex justify-content-center" style="padding: 2%">
                <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">قيمة الإشتراك:</h4></label>
                <input type="Number" class="col-6"  name="subscriptionValue" id="subscriptionValue" style="width: 400px"  required />
            </div>
            </div>
        </div>


        <!--Grid row-->

        <!--Grid row-->
        <div class="row d-flex justify-content-center" style="padding-top: 60px">
            <!--Grid column-->
            <button class="btn btn-primary" name="submit" type="submit" value="Submit">إضافة مشترك</button>
            <!--Grid column-->
        </div>
    </form>







</main>






<?php
echo $pageContents[0][2];
?>

</body>
</html>
