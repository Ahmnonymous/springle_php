<?php
session_start();
include('db_sql.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sal_id = $_POST["customer_id"];
  $customer_name = $_POST["customers_name"];
  $quantity = $_POST["quantity"];
  $bot_rec = $_POST["bot_rec"];
  $bot_balance = $_POST["bottle_balance"];
  $pay_received = $_POST["pay_received"];
  $rate = $_POST["rate"];
  $contact = $_POST["contact"];
  //$date = $_POST["date"];
  $amount = $quantity * $rate;

  $sql = "INSERT INTO sale_detail (Sal_id, Customers_name, Quantity, Bot_rec, Rate, Amount, Bottle_balance, Pay_received,contact) 
          VALUES ('$sal_id', '$customer_name', $quantity, $bot_rec, $rate, $amount, $bot_balance, $pay_received,$contact)";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Record inserted successfully!";
  } else {
    $_SESSION['error_message'] = "Error inserting record: " . $conn->error();
  }

} else {
  echo "Server method is not POST.";
}

$conn->close();
header("Location: form.php");
?>
