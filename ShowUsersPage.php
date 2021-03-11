
<?php
require_once('DataBase.php');
require_once('User.php');
session_start();
if(!isset($_SESSION["LoginUser"]))
{
    header("Location: ./LoginPage.php");
    exit();
}
$User=new User();

$User=$User->showAllData();

$pageContents=DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
$TypeToArray= array('1'=>'أدمن','2'=>'محاسب');
$u=$_SESSION["LoginUser"];
//$allowedPages=$u->getAllowedPages();


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
                    <th scope="col">تاريخ التسجيل</th>
                    <th scope="col">آخر تسجيل دخول</th>
                    <th scope="col">حذف</th>



                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($User as $record)
                    {
                        echo "<tr class='table-light'>";
                        echo "<td>".$record['id']."</td>";
                        echo "<td>".$record['name']."</td>";
                        echo "<td>".$TypeToArray[$record['type']]."</td>";
                        echo "<td>".$record['userName']."</td>";
                        echo "<td>".$record['password']."</td>";
                        echo "<td>".$record['registerationDate']."</td>";
                        echo "<td>".$record['LastSignIn']."</td>";
                        echo "<td><a href='./DeleteUserPage.php?userId=".$record['id']."'><button type='button' class='btn btn-danger'>حذف</button></a></td>";
                        echo"</tr>";

                    }
                    ?>


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
