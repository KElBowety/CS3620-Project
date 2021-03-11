
<?php
require_once('DataBase.php');
require_once('User.php');

session_start();
if(!isset($_SESSION["LoginUser"]))
{
    header("Location: ./LoginPage.php");
    exit();
}

$pageContents=DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");

$pageId=2;
$currUser=unserialize($_SESSION['LoginUser']);
if (!$currUser->checkAccess($pageId))
{
    header("Location: ./LoginPage.php");
    $_SESSION['errorMessage']="هذا المستخدم ليس لديه وصول لتلك الصفحة";
    exit();
}


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> إضافة مستخدم <?php
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
    <h2 class="text-white text-center" style="padding-top: 10px ">  إضافة مستخدم جديد </h2>

    <form  style="padding-top: 5%; padding-bottom: 5%" action="./AddUserValidation.php" method="post" name="form_submitted">
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">الإسم:</h4></label>
                <input type="text" class="col-6"  name="name" id="name" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">الرقم القومي:</h4></label>
                    <input type="number" class="col-6"  name="id" id="id" style="width: 400px"  required />
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">إسم المستخدم:</h4></label>
                <input type="text" class="col-6"  name="userName" id="userName" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label class="label col-4"  ><h4 class="text-white">الوظيفة:</h4></label>
                    <select name="type" id="type" style="width: 100px" required>
                        <option value=1>أدمن</option>
                        <option value=2>محاسب</option>
                    </select>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">كلمة السر:</h4></label>
                <input type="password" class="col-6"  name="password" id="password" style="width: 400px"  required />
            </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
            <div class="row" >
                <label  class="label col-4"  ><h4 class="text-white">تأكيد كلمة السر:</h4></label>
                <input type="password" class="col-6"  name="password2" id="password2" style="width: 400px"  required />
            </div>
            </div>
        </div>


        <!--Grid row-->

        <!--Grid row-->
        <div class="row d-flex justify-content-center" style="padding-top: 60px">
            <!--Grid column-->
            <button class="btn btn-primary" name="submit" type="submit" value="Submit">إضافة مستخدم جديد</button>
            <!--Grid column-->
        </div>
    </form>
</main>

<?php
echo $pageContents[0][2];
?>

</body>
</html>
