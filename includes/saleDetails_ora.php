<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sal_id = $_POST["customer_id"];
  $customer_name = $_POST["customers_name"];
  $quantity = $_POST["quantity"];
  $bot_rec = $_POST["bot_rec"];
  $bot_balance = $_POST["bottle_balance"];
  $pay_received = $_POST["pay_received"];
  $rate = $_POST["rate"];
  $contact = $_POST["contact"];
  $date = $_POST["date"];
  $amount = $quantity * $rate;

  $escaped_sal_id = oci_escape_string($conn, $sal_id);
  $escaped_customer_name = oci_escape_string($conn, $customer_name);
  $escaped_quantity = intval($quantity);
  $escaped_bot_rec = intval($bot_rec);
  $escaped_bot_balance = intval($bot_balance);
  $escaped_pay_received = intval($pay_received);
  $escaped_rate = floatval($rate);
  $escaped_amount = floatval($amount);
  $escaped_contact = intval($contact);
  $escaped_date = oci_escape_string($conn, $date);

  $sql = "INSERT INTO sale_detail (book_id, sal_id, customer_name, bot_issue, Bot_recived, Rate, Amount, Bot_balance, Pay_recived, to_date) 
          VALUES (2237, '$escaped_sal_id', '$escaped_customer_name', $escaped_quantity, $escaped_bot_rec, $escaped_rate, $escaped_amount, $escaped_bot_balance, $escaped_pay_received, '$escaped_date')";

  $query = oci_parse($conn, $sql);
  $result = oci_execute($query);

  if ($result) {
    $_SESSION['success_message'] = "Record inserted successfully!";
  } else {
    $_SESSION['error_message'] = "Error inserting record.";
  }

  oci_free_statement($query);
} else {
  echo "Server method is not POST.";
}

oci_close($conn);
header("Location: ../form.php");
?>
