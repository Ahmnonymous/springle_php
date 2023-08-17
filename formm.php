<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: index.php");
    exit;
}

// Database connection details
$username = 'HR';
$password = 'HR';
$db = '124.29.225.97:1521/orcl';
$usernam = $_SESSION['username'];

$conn = oci_connect($username, $password, $db);
if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}

$sql = "SELECT CLAINT_ID, NAME, rate, Bot_bal, pay_bal, mobile, ref_id FROM DATA_FATCH_VIEW 
          WHERE active ='1'
          AND ref = :usernam";

$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ":usernam", $usernam);

if (!oci_execute($stid)) {
    $error = oci_error($stid);
    die("Error executing query: " . $error['message']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--link rel="stylesheet" href="js/jquery-ui.css"-->
  <link rel="stylesheet" href="css/fstyle.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #f5f4f4;">
    <div class="container mt-4">
        <?php
        if (isset($_SESSION['success_message'])) {
            $message = $_SESSION['success_message'];
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '$message',
                customClass: {
                    confirmButton: 'bg-success shadow-none',
                }
            });
            </script>";
            unset($_SESSION['success_message']);
        }
        ?>

        <div class="container mt-4">
            <section>
                <form method="POST" action="sales_ora.php" class="custom-form mx-auto mb-5 contact-form bg-white p-5 shadow">
                    <?php
                    while ($row = oci_fetch_assoc($stid)) {
                        $customer_id = $row['CLAINT_ID'];
                        $customer_name = $row['NAME'];
                        $rate = $row['rate'];
                        $bottle_balance = $row['Bot_bal'];
                        $pay_balance = $row['pay_bal'];
                        $contact = $row['mobile'];
                        $refid = $row['ref_id'];
                        echo "<h2 class=\"title text-center\">Welcome, $usernam!</h2>";
                        echo "<h2 class=\"title text-center\"><b>Sale Details</b></h2>";
                        ?>
                        <?php $username = $_SESSION['username'];echo "<h2 class=\"title text-center\">Welcome, $username!</h2>";?>
    <h2 class="title text-center"><b>Sale Details</b></h2>  
    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="customer_id" name="customer_id" placeholder="Customer ID" class="input-text js-input form-control shadow-none rounded-0" type="text" required>
          <!--label class="label" for="customer_id">Cus ID</label-->
        </div>
        <!-- Replace the existing "Customer Name" input field -->
        <div class="form-field col-sm-4 mx-auto">
            <select id="customer_name" name="customer_name" class="input-text js-input form-control shadow-none rounded-0" required>
                <option value="" selected disabled>Select Customer Name</option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['NAME'] . "'>" . $row['NAME'] . "</option>";
                }
                ?>
            </select>
            <!--label class="label" for="name">Customer's Name</label-->
        </div>

      </div>
      <div class="row">
          
          <div class="form-field col-sm-4 mx-auto">
          <input id="rate" name="rate" placeholder="Rate" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <!--label class="label" for="rate">Rate</label-->
        </div>
        
        <div class="form-field col-sm-4 mx-auto">
          <input id="quantity" name="quantity" placeholder="Quantity" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <!--label class="label" for="quantity">Quantity</label-->
        </div>
      </div>
      <div class="row">
       <div class="form-field col-sm-4 mx-auto">
          <input id="bot_rec" name="bot_rec" placeholder="Bot Received" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <!--label class="label" for="BotRecord">Bot Record</label-->
        </div>
        
        <div class="form-field col-sm-4 mx-auto">
          <input id="bottle_balance" name="bottle_balance" placeholder="Bot Balance" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <!--label class="label" for="bottle_balance">Bot Balance</label-->
        </div>
      </div>
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="amount" name="amount" placeholder="Amount" class="input-text js-input form-control shadow-none bg-white rounded-0" type="text" disabled required>
          <!--label class="label" for="amount" style="top: -19px">Amount</label-->
        </div>
        <div class="form-field col-sm-4 mx-auto">
          <input id="pay_received" name="pay_received" placeholder="Payment Received" class="input-text js-input form-control shadow-none" type="number" required>
          <!--label class="label" for="payReceived">Pay Received</label-->
        </div>
      </div>
      <div class="row">
           <div class="form-field col-sm-4 mx-auto">
          <input id="pay_balance" name="pay_balance" placeholder="Pay Balance" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <!--label class="label" for="BotRecord">Pay Balance</label-->
        </div>
        
           <div class="form-field col-sm-4 mx-auto">
          <input id="contact" name="contact" placeholder="Contact" class="input-text js-input form-control shadow-none" type="text" required>
          <!--label class="label" for="mobile">Contact</label-->
        </div>
      </div>
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="date" name="date" placeholder="Date" class="input-text js-input form-control shadow-none bg-white rounded-0" type="date">
          <!--label class="label" for="date" style="top: -19px">Date</label-->
        </div>
          <div class="col-sm-4 mx-auto"></div>
      </div>
      <div class="form-field col-sm-12 text-center">
    <input class="submit-btn btn btn-primary" type="submit" value="Save">
      </div>
                        <?php
                    }
                    oci_free_statement($stid);
                    oci_close($conn);
                    ?>
                </form>
            </section>
        </div>
    </div>
    <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
    $('.js-input').keyup(function() {
      if ($(this).val()) {
        $(this).addClass('not-empty');
      } else {
        $(this).removeClass('not-empty');
      }
    });
    $("#quantity, #rate").on('input', function() {
            var qty = parseFloat($("#quantity").val()) || 0;
            var rate = parseFloat($("#rate").val()) || 0; 
            var amount = (qty * rate);
            $("#amount").val(amount.toFixed(2));
        });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
