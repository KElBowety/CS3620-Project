<?php
require_once('DataBase.php');
session_start();
//if (isset($_SESSION["LoginUser"])) {
//    header("Location: ./admin.php");
//    exit();
//}
$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> تسجيل الدخول <?php
                    echo $pageContents[2][2];
                    ?>
</head>

<body dir="rtl">

    <?php
    echo $pageContents[3][2];
    ?>

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
        ?>

        <script>
            function validateForm() {
                var x = document.forms["DonoInfo"]["userName"].value;
                if (x == "" || x.length > 30) {
                    return false;
                }
            }
        </script> alert("Name must be filled out or exceed limit");

        <form style="padding-top: 15%; padding-bottom: 15%" action="./LogInValidation.php" method="post" name="DonoInfo" onsubmit="return validateForm()">
            <div class="row d-flex justify-content-center">
                <div class="form-outline">
                    <label for="userName" class="form-label">
                        <h4 class="text-white">إسم المستخدم</h4>
                    </label>
                    <input type="text" class="form-control" name="userName" id="userName" required />
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="padding-top: 20px">
                <div class="form-outline">
                    <label for="password" class="form-label">
                        <h4 class="text-white">كلمة السر</h4>
                    </label>
                    <input type="password" class="form-control" name="password" id="password" required />
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row d-flex justify-content-center" style="padding-top: 60px">
                <!--Grid column-->
                <button class="btn btn-primary" name="submit" type="submit" value="Submit">تسجيل الدخول</button>
                <!--Grid column-->
            </div>
        </form>
    </main>

    <?php
    echo $pageContents[0][2];
    ?>

</body>

</html>