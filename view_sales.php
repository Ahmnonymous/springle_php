<?php
session_start();


// Check if the reference value is sent as a query parameter
if(isset($_GET['ref'])) 
    $ref = $_GET['ref'];

// Database connection details
$username = 'HR';
$password = 'HR';
$db = '124.29.225.97:1521/orcl'; 

$conn = oci_connect($username, $password, $db);
if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}

// Fetch sales data from the database
$sql = "SELECT * FROM SALE_DETAIL WHERE REF = '$ref'";

$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--link rel="stylesheet" href="js/jquery-ui.css"-->
  <link rel="stylesheet" href="css/fstyle.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2>Sales Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Bottle Received</th>
                    <th>Bottle Balance</th>
                    <th>Amount</th>
                    <th>Payment Received</th>
                    <th>Payment Balance</th>
                    <th>Contact</th>
                    <th>Dated</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = oci_fetch_assoc($stmt)) { ?>
                    <tr>
                        <td><?php echo $row['SAL_ID']; ?></td>
                        <td><?php echo $row['CUSTOMER_NAME']; ?></td>
                        <td><?php echo $row['RATE']; ?></td>
                        <td><?php echo $row['BOT_ISSUE']; ?></td>
                        <td><?php echo $row['BOTTLE_RECIVD']; ?></td>
                        <td><?php echo $row['BOT_BALANCE']; ?></td>
                        <td><?php echo $row['AMOUNT']; ?></td>
                        <td><?php echo $row['PAY_RECIVED']; ?></td>
                        <td><?php echo $row['PAY_BALANCE']; ?></td>
                        <td><?php echo $row['TO_DATE']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close Oracle connection
oci_free_statement($stmt);
oci_close($conn);
?>
