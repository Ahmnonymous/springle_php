<?php
// fetch_data.php

// Database connection details
$username = 'HR';
$password = 'HR';
$db = '124.29.225.97:1521/orcl'; 

$conn = oci_connect($username, $password, $db);
if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}

$usernam = $_SESSION['username'];

$sql = "SELECT T.CLAINT_ID, T.NAME, T.rate, T.Bot_bal, T.pay_bal, T.mobile, t.ref_id FROM DATA_FATCH_VIEW T
          WHERE T.active ='1'
          AND T.ref = :usernam";

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":usernam", $usernam);

oci_execute($stid);
?>

<!-- Echo all fields for debugging purposes -->
<table border="1">
    <tr>
        <th>CLAINT_ID</th>
        <th>NAME</th>
        <th>rate</th>
        <th>Bot_bal</th>
        <th>pay_bal</th>
        <th>mobile</th>
        <th>ref_id</th>
    </tr>
    <?php
    while ($row = oci_fetch_assoc($stid)) {
        echo "<tr>";
        echo "<td>" . $row['CLAINT_ID'] . "</td>";
        echo "<td>" . $row['NAME'] . "</td>";
        echo "<td>" . $row['rate'] . "</td>";
        echo "<td>" . $row['Bot_bal'] . "</td>";
        echo "<td>" . $row['pay_bal'] . "</td>";
        echo "<td>" . $row['mobile'] . "</td>";
        echo "<td>" . $row['ref_id'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
