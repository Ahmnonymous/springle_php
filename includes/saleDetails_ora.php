<?php
session_start();

// Database connection details
$username = 'HR';
$password = 'HR';
$db = '124.29.225.97:1521/orcl'; 

$conn = oci_connect($username, $password, $db);
if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}

echo "Connected to Oracle Database!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sal_id = $_POST["customer_id"];
    $customer_name = $_POST["customer_name"];
    $quantity = $_POST["quantity"];
    $bot_rec = $_POST["bot_rec"];
    $bot_balance = $_POST["bottle_balance"];
    $pay_received = $_POST["pay_received"];
    $pay_balance = $_POST["pay_balance"];
    $rate = $_POST["rate"];
    $contact = $_POST["contact"];
    $date = $_POST["date"];
    $amount = $quantity * $rate;

    // Oracle-specific: Construct the SQL statement
    $sql = "INSERT INTO SALE_DETAIL(book_id,sal_id, customer_name, bot_issue,bottle_recived, rate, amount, bot_balance, pay_recived,pay_balance,to_date) 
            VALUES (2237,:sal_id, :customer_name, :quantity, :bot_rec, :rate, :amount, :bot_balance, :pay_received,:pay_balance,:to_date)";

    // Prepare the statement
    $stmt = oci_parse($conn, $sql);

    // Bind the parameters
    oci_bind_by_name($stmt, ':sal_id', $sal_id);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_bind_by_name($stmt, ':quantity', $quantity);
    oci_bind_by_name($stmt, ':bot_rec', $bot_rec);
    oci_bind_by_name($stmt, ':rate', $rate);
    oci_bind_by_name($stmt, ':amount', $amount);
    oci_bind_by_name($stmt, ':bot_balance', $bot_balance);
    oci_bind_by_name($stmt, ':pay_received', $pay_received);
    oci_bind_by_name($stmt, ':pay_balance', $pay_balance);
    oci_bind_by_name($stmt, ':to_date', $date);

    // Execute the statement
    $result = oci_execute($stmt);
    
    if ($result) {
        $_SESSION['success_message'] = "Record inserted successfully!";
    } else {
        $error = oci_error($stmt);
        $_SESSION['error_message'] = "Error inserting record: " . $error['message'];
    }

    // Free the statement
    oci_free_statement($stmt);

    oci_close($conn); // Close Oracle connection
    
    // Display success message
    echo "Record inserted successfully!";
} else {
    echo "Server method is not POST";
}
?>
