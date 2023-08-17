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

//$usernam = $_SESSION['username'];

$sql = "SELECT T.CLAINT_ID, T.NAME, T.rate, T.Bot_bal, T.pay_bal, T.mobile, t.ref_id FROM DATA_FATCH_VIEW T
          WHERE T.active ='1'";

$stid = oci_parse($conn, $sql);
if (!$stid) {
    $error = oci_error($conn);
    die("Error parsing SQL: " . $error['message']);
}

oci_execute($stid);
if (!$stid) {
    $error = oci_error($conn);
    die("Error executing SQL: " . $error['message']);
}

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
        echo "<td>" . $row['RATE'] . "</td>";  // Use uppercase for RATE
        echo "<td>" . $row['BOT_BAL'] . "</td>";  // Use uppercase for BOT_BAL
        echo "<td>" . $row['PAY_BAL'] . "</td>";  // Use uppercase for PAY_BAL
        echo "<td>" . $row['MOBILE'] . "</td>";  // Use uppercase for MOBILE
        echo "<td>" . $row['REF_ID'] . "</td>";  // Use uppercase for REF_ID
        echo "</tr>";
    }
    ?>
</table>
