
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
    ?>تأكيد التبرع<?php
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




    <h1 class="text-white text-center">  تأكيد التبرع </h1>
    <form  style="padding-top: 15%; padding-bottom: 15%" action="./ConfirmDonationValidation.php" method="post">
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">إسم المتبرع:</h4></label>
                    <input type="text" class="col-6"  name="userName" id="userName" style="width: 400px"  required />
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">رقم التليفون:</h4></label>
                    <input type="text" class="col-6"  name="userName" id="userName" style="width: 400px"  required />
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">رقم البطاقة:</h4></label>
                    <input type="number" class="col-6"  name="userName" id="userName" style="width: 400px"  required />
                </div>
            </div>
        </div>


        <!--Grid row-->

        <!--Grid row-->
        <div class="row d-flex justify-content-center" style="padding-top: 60px">
            <!--Grid column-->
            <button class="btn btn-primary" name="submit" type="submit" value="Submit">تأكيد التبرع</button>
            <!--Grid column-->
        </div>
    </form>





    <div  class="row-cols-1" style="padding-top: 5%; padding-bottom: 5%">
        <h4 class="text-white text-center">  تبرعات غير مؤكدة </h4>




        <div class="container">
            <table class="table" dir="rtl">
                <thead>
                <tr class="table-dark">
                    <th scope="col">نوع التبرع</th>
                    <th scope="col">صنف/عملة</th>
                    <th scope="col">قيمة</th>
                    <th scope="col">عدد</th>
                    <th scope="col">إجمالى</th>
                    <th scope="col">مدة الصلاحية بالأيام</th>

                </tr>
                </thead>
                <tbody>
                <tr class="table-light">
                    <td>تحربة</td>
                    <td>تجربة</td>
                    <td>تحربة</td>
                    <td>تجربة</td>
                    <td>تحربة</td>
                    <td>تجربة</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        <a>
            <button type="button" class="btn btn-primary">تأكيد ومتابعة</button>
        </a>
    </div>





</main>






<?php
echo $pageContents[0][2];
?>

</body>
</html>
