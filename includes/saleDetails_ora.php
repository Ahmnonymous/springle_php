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

  // Escape values to prevent SQL injection
  $sal_id = mysqli_real_escape_string($conn, $sal_id);
  $customer_name = mysqli_real_escape_string($conn, $customer_name);
  $quantity = intval($quantity);
  $bot_rec = intval($bot_rec);
  $bot_balance = intval($bot_balance);
  $pay_received = intval($pay_received);
  $rate = floatval($rate);
  $amount = floatval($amount);
  $contact = intval($contact);
  $date = mysqli_real_escape_string($conn, $date);

  $sql = "INSERT INTO sale_detail (book_id, sal_id, customer_name, bot_issue, Bot_recived, Rate, Amount, Bot_balance, Pay_recived, to_date) 
          VALUES (2237, '$sal_id', '$customer_name', $quantity, $bot_rec, $rate, $amount, $bot_balance, $pay_received, '$date')";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Record inserted successfully!";
  } else {
    $_SESSION['error_message'] = "Error inserting record: " . $conn->error();
  }
} else {
  echo "Server method is not POST.";
}

$conn->close();
header("Location: ../form.php");
?>
