<?php
session_start();
if(isset($_SESSION['exportedPage'])) {
    unset($_SESSION['exportedPage']);
    echo "<table><thead><tr>";
    for($i = 0; $i < count($_SESSION['ids']); $i++) {
        echo "<td>".$_SESSION['ids'][$i][0]."</td>";
    }
    echo "</tr></thead><tbody>";
    for($i = 0; $i < count($_SESSION['results']); $i++) {
        echo "<tr>";
        for($j = 0; $j < count($_SESSION['ids']); $j++) {
            echo "<td>".$_SESSION['results'][$i][$j]."</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
}
?>

<html>

<head>
    <title>Exported Page</title>
    <style>
        table,
        th,
        td { border: 1px solid black; }
    </style>
</head>

</html>
