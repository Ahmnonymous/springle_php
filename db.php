<?php
$db_user = 'HR';
$db_password = 'HR';
$db_host = '124.29.225.97:1521/orcl'; 

$conn = oci_connect($db_user, $db_password, $db_host);

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else {
    echo "Connected to Oracle successfully!";
}

oci_close($connection);
?>
