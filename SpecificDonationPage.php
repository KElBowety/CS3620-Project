<?php
require_once('DataBase.php');
require_once('Donation.php');
require_once ('TempDonor.php');

session_start();
if (!isset($_SESSION["LoginUser"])) {
    header("Location: ./LoginPage.php");
    exit();
}
if (!isset($_GET['donorId'])||!isset($_GET['donationId']))
{
    header("Location: ./showDonationsPage.php");
    exit();
}

$pageContents = DataBase::ExcuteRetreiveQuery("SELECT * FROM `page` WHERE 1");
$Donor = new TempDonor();
$Donor->findById($_GET['donorId']);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <?php
    echo $pageContents[1][2];
    ?> تفاصيل التبرع <?php
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
        <?php echo"<h1 dir='rtl' class='text-white text-center'>  تفاصيل التبرع ".$_GET['donationId']." </h1>";?>

        <div class="row" style="padding-top: 10%; padding-bottom: 10%">




           <?php echo $Donor->getId(); ?>


            <table class="table">

                <tbody>
                <tr>
                    <td class="table-info">الإسم</td>
                    <td class="table-light"><?php echo $Donor->getName();?></td>
                </tr>
                <tr>
                    <td class="table-info">الرقم القومي</td>
                    <td class="table-light"><?php echo $Donor->getNationalId();?></td>
                </tr>
                <tr>
                    <td class="table-info">رقم المحمول</td>
                    <td class="table-light"><?php echo $Donor->getPhoneNumber();?></td>
                </tr>
                <tr>
                    <td class="table-info">كود المتبرع</td>
                    <td class="table-light"><?php echo $Donor->getId();?></td>
                </tr>

                </tbody>
            </table>



        </div>
        <?php echo"<h1 dir='rtl' class='text-white text-center'>  تبرعات عينية </h1>";?>
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
            $donationId=$_GET['donationId'];
            $query="SELECT donationID,donationdetails.itemId, itemValue, name, quantity from donationdetails INNER JOIN (SELECT item.id, itemValue, name, quantity FROM item INNER JOIN inkind WHERE item.id=inkind.itemId) AS tab ON tab.id=donationdetails.itemId WHERE donationID=".$donationId;
            $result=DataBase::ExcuteRetreiveQuery($query);


            if ($result!=false) {
                foreach ($result as $record) {
                    echo "<tr class='table-light'>";
                    echo "<td>" . $record['itemId'] . "</td>";
                    echo "<td>" . $record['name'] . "</td>";
                    echo "<td>" . $record['itemValue'] . "</td>";
                }
            }

            ?>
            </tbody>
        </table>
    </div>





</main>






<?php
echo $pageContents[0][2];
?>

</body>

</html>