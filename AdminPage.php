<?php
require_once('DataBase.php');
include 'Donation.php';
$x = array();
$Donation = new Donation(0, 0, "", $x);
session_start();
//if(!isset($_SESSION["LoginUser"]))
//{
//    header("Location: ./LoginPage.php");
//    exit();
//}

$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
$Donation->initializeDB("localhost", "root", "", "test2");
$data = $Donation->readData("donations");

for ($i = 0; $i < count($data); $i++) {
    array_push($dataPoints, array("y" => $data[$i]['value'], "label" => $data[$i]['id']));
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
                    text: "تبرعات"
                },
                subtitles: [{
                    text: "مالي"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

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









        <div style="padding-top: 15%; padding-bottom: 15%">


            <h1 class="text-white text-center"> غير مكتملة</h1>
        </div>





    </main>






    <?php
    echo $pageContents[0][2];
    ?>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>