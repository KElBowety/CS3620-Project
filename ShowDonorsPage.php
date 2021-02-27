<?php
require_once('DataBase.php');
include 'DonationDetail.php';
session_start();
//if(!isset($_SESSION["LoginUser"]))
//{
//    header("Location: ./LoginPage.php");
//    exit();
//}

$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");

$DonationDetail = new DonationDetail(0, 0, 0, 0, 0);


$DonationDetail->initializeDB("localhost", "root", "", "test2");
$data = $DonationDetail->readData("donation_details");

$dataPoints = array();

for ($i = 0; $i < count($data); $i++) {
    array_push($dataPoints, array("y" => $data[$i]['quantity'], "label" => $data[$i]['id']));
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "كميات التبرع"
                },
                axisY: {
                    title: "كمية",
                    includeZero: true,
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

    <?php
    echo $pageContents[1][2];
    ?> قائمة الإشتراكات <?php
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








        <div class="container">
            <h1 class="text-white text-center"> قائمة الإشتراكات </h1>

            <div class="row" style="padding-top: 10%; padding-bottom: 10%">





                <table class="table col-12" dir="rtl">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">كود</th>
                            <th scope="col">الإسم</th>
                            <th scope="col">السن</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">رقم التليفون</th>
                            <th scope="col">رقم البطاقة</th>
                            <th scope="col">نوع الإشتراك</th>
                            <th scope="col">قيمة الإشتراك</th>
                            <th scope="col">تاريخ الإدخال</th>
                            <th scope="col">كود المدخل</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-light">
                            <td>تحربة</td>
                            <td>تحربة</td>
                            <td>تجربة</td>
                            <td>تحربة</td>
                            <td>تجربة</td>
                            <td>تحربة</td>
                            <td>تجربة</td>
                            <td>تحربة</td>
                            <td>تجربة</td>
                            <td>تجربة</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>





    </main>






    <?php
    echo $pageContents[0][2];
    ?>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>