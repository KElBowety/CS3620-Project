
<?php
require_once('DataBase.php');
session_start();
if(!isset($_SESSION["LoginUser"]))
{
    header("Location: ./LoginPage.php");
    exit();
}
include 'Financial.php';
include 'Clothes.php';
include 'Food.php';
include 'Furniture.php';
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
                    <input type="text" class="col-6"  name="name" id="name" style="width: 400px"  required />
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">رقم التليفون:</h4></label>
                    <input type="text" class="col-6"  name="phone" id="phone" style="width: 400px"  required />
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center" style="padding: 2%">
            <div class="container">
                <div class="row" >
                    <label  class="label col-4"  ><h4 class="text-white">رقم البطاقة:</h4></label>
                    <input type="number" class="col-6"  name="idNumber" id="idNumber" style="width: 400px"  required />
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
        <h4 class="text-white text-center">  تفاصيل التبرع </h4>




        <div class="container">
            <table class="table" dir="rtl">
                <thead>
                <tr class="table-dark">
                    <th scope="col">نوع التبرع</th>
                    <th scope="col">صنف/عملة</th>
                    <th scope="col">قيمة</th>
                    <th scope="col">عدد</th>
                    <th scope="col">إجمالى</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_SESSION['donations'])) {
                    if (empty($_SESSION['donations'])){

                    }else{

                        $myarr=unserialize($_SESSION['donations']);
                        for ($i=0;$i<count($myarr);$i++)
                        {
                            echo '<tr class="table-light">';
                            echo $i;
                            $obj=unserialize($myarr[$i]);
                            print_r($obj);
                            if (is_a($obj, 'Financial')) {
                                echo "<td>تبرع مالى</td>";
                                echo "<td>نقدي</td>";
                                echo "<td>".$obj->getValue()."</td>";
                                echo "<td>1</td>";
                                echo "<td>".$obj->getValue()."</td>";

                            }else{
                                echo "<td>تبرع عيني</td>";
                                if (is_a($obj, 'Clothes'))
                                    echo "<td>ملابس</td>";
                                if (is_a($obj, 'Furniture'))
                                    echo "<td>أثاث</td>";
                                if (is_a($obj, 'Food'))
                                    echo "<td>طعام</td>";
                                echo "<td>".$obj->getItemValue()."</td>";
                                echo "<td>".$obj->getQuantity()."</td>";
                                echo "<td>".$obj->getValue()."</td>";
                                echo '</tr>';

                            }
                        }

                    }
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
