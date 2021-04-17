<?php
require_once('DataBase.php');
require_once('Donation.php');

session_start();
if (!isset($_SESSION["LoginUser"])) {
    header("Location: ./LoginPage.php");
    exit();
}

$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
$Donor = new Donation();
$Donor = $Donor->showAllData();

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> قائمة التبرعات <?php
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
        <h1 class="text-white text-center"> قائمة التبرعات </h1>


        <div class="row" style="padding-top: 10%; padding-bottom: 10%">




            <table class="table col-12" dir="rtl">
                <thead>
                <tr class="table-dark">
                    <th scope="col">كود التبرع</th>
                    <th scope="col">كود المتبرع</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">عرض</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if ($Donor!=false) {
                    foreach ($Donor as $record) {
                        echo "<tr class='table-light'>";
                        echo "<td>" . $record['id'] . "</td>";
                        echo "<td>" . $record['donorId'] . "</td>";
                        echo "<td>" . $record['date'] . "</td>";
                        echo "<td> <a href='./SpecificDonationPage.php?donorId=". $record['donorId'] ."&donationId=". $record['id'] ."'><button type='button' class='btn btn-warning'>عرض</button></a></td>";
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