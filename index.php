<?php
include "Subject.php";
include "GoodFood.php";
include "BadFood.php";

$subject = new Subject();

$o1 = new GoodFood();
$subject->attach($o1);

$o2 = new BadFood();
$subject->attach($o2);

$bar1=$subject->someBusinessLogic("21/2/2010");
echo $bar1;
$bar2=$subject->someBusinessLogic("31/4/2011");

$subject->detach($o2);

$bar3=$subject->someBusinessLogic("2/2/2019");

$bar1=11;

$dataPoints = array(
    array("y" => 11,"label" => "Food A" ),
    array("y" =>10,"label" => "Food B" ),
    array("y" => 2,"label" => "Food C" )
);

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title:{
                    text: "Years left"
                },
                axisY: {
                    title: "years",
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
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>