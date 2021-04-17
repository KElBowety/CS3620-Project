
<?php
require_once('DataBase.php');
session_start();

if(!isset($_SESSION["LoginUser"]))
{
    header("Location: ./LoginPage.php");
    exit();
}


$pageContents=DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> الرئيسية <?php
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









    <div  style="padding-top: 15%; padding-bottom: 15%">


        <h1 class="text-white text-center"> جمعية شبرا الخير</h1>
    </div>





</main>






<?php
echo $pageContents[0][2];
?>

</body>
</html>
