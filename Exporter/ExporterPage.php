<?php
require_once('Exporter.php');
require_once('ExportedPageGenerator.php');
require_once('ExcelGenerator.php');

session_start();
if(!empty($_POST)) {
    $exporter = new Exporter($_POST);
    if(!empty($_POST['excel'])) {
        $excel = new ExcelGenerator();
        $exporter->attach($excel);
    }
    if(!empty($_POST['page'])) {
        $page = new ExportedPageGenerator();
        $exporter->attach($page);
    }
    $exporter->notify();
}
?>

<html>
<head>
    <title>Exporter</title>
</head>
<body>
    <h1>Select the table you want to export:</h1>
    <form action="ExporterPage.php" method="post">
        <label for='table'>Table: </label>
        <select name='table' id='table'>
            <option value='users'>Users</option>
            <option value='donors'>Donors</option>
            <option value='items'>Items</option>
            <option value='donations'>Donations</option>
        </select> <br>
        <input type="checkbox" id="page" value="page" name="page">
        <label for="page">Page</label> <br>
        <input type="checkbox" id="excel" value="excel" name="excel">
        <label for="excel">Excel</label> <br>
        <input type="checkbox" id="pdf" value="pdf" name="pdf">
        <label for="pdf">PDF</label> <br>
        <input type='submit' value="Enter">
    </form>
</body>
</html>
