
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
    ?> قائمة المستخدمين <?php
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








    <div class="container">
        <h1 class="text-white text-center">  قائمة المستخدمين </h1>

        <div  class="row" style="padding-top: 10%; padding-bottom: 10%">





            <table class="table col-12" dir="rtl">
                <thead >
                <tr class="table-dark">
                    <th scope="col">كود</th>
                    <th scope="col">الإسم</th>
                    <th scope="col">الوظيفة</th>
                    <th scope="col">إسم المستخدم</th>
                    <th scope="col">كلمة السر</th>
                    <th scope="col">تعليق</th>
                    <th scope="col">حذف</th>



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
                    <td>تحربة</td>

                </tr>
                </tbody>
            </table>

        </div>
    </div>




</main>






<?php
echo $pageContents[0][2];
?>

</body>
</html>
