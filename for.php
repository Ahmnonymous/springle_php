<?php
session_start();

// Database connection details
$user = 'HR';
$password = 'HR';
$db = '124.29.225.97:1521/orcl';

// Establish a database connection
$conn = oci_connect($user, $password, $db);
if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}

// Retrieve the logged-in user's username
$username = $_SESSION['username'];

// Define the SQL query
$sql = "SELECT T.CLAINT_ID, T.NAME, T.rate, T.Bot_bal, T.pay_bal, T.mobile, t.ref_id 
        FROM DATA_FATCH_VIEW T
        WHERE T.active = '1' AND t.ref = :username
        ORDER BY T.NAME ASC";


// Prepare the SQL statement
$stid = oci_parse($conn, $sql);
if (!$stid) {
    $error = oci_error($conn);
    die("Error parsing SQL: " . $error['message']);
}

// Bind the user parameter
oci_bind_by_name($stid, ':username', $username);

// Execute the statement
$result = oci_execute($stid);
if (!$result) {
    $error = oci_error($stid);
    die("Error executing SQL: " . $error['message']);
}

// Fetch all rows and store in an array
$dataArray = array();
while ($row = oci_fetch_assoc($stid)) {
    $dataArray[] = $row;
}

// Free the statement and close the connection
oci_free_statement($stid);
oci_close($conn);
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
  <style>
  .form-field {
    position: relative;
    margin-bottom: 20px;
  }

  .label {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    transition: 0.2s ease all;
  }

  .input-text {
    padding: 10px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .input-text:focus + .label,
  .input-text.not-empty + .label {
    top: -20px;
    font-size: 12px;
    color: #007bff;
  }
</style>


</head>


<body style="background-color: #f5f4f4;">

<?php
if(isset($_SESSION['auth']))
{
?>
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
          })
            </script>";
      unset($_SESSION['success_message']);
    }
    ?>

<div class="container mt-4">
</section>
<form method="POST" action="sales_ora.php" class="custom-form  mx-auto mb-5 contact-form bg-white p-5 shadow">
    <?php $username = $_SESSION['username'];echo "<h2 class=\"title text-center\">Welcome, $username!</h2>";?>
    <h2 class="title text-center"><b>Sale Details</b></h2>  


    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
            <p>Customer Name</p>
        <label class="label" for="customer_name">Customer Name</label>
            <select id="customer_name" name="customer_name" class="input-text js-input form-control shadow-none rounded-0" required>
                <option value="" selected disabled>Select Customer Name</option>
                <?php
                foreach ($dataArray as $row) {
                    echo "<option value='" . $row['NAME'] . "'>" . $row['NAME'] . "</option>";
                }
                ?>
            </select>
        </div>
        
    <div class="form-field col-sm-4 mx-auto">
    <label class="label" for="customer_id">Customer ID</label>
        <input id="customer_id" name="customer_id" placeholder=" " class="input-text js-input form-control shadow-none rounded-0" type="text" disabled required>
    </div>

    </div>

    <div class="row">

        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="rate">Rate</label>
            <input id="rate" name="rate" placeholder=" " class="input-text js-input form-control shadow-none rounded-0" type="number" required>
        </div>

        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="quantity">Quantity</label>
          <input id="quantity" name="quantity" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
        </div>

    </div>

    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="amount">Amount</label>
          <input id="amount" name="amount" class="input-text js-input form-control shadow-none bg-white rounded-0" type="text" disabled required>
        </div>
    
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="bot_rec">Bottle Received</label>
          <input id="bot_rec" name="bot_rec" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
        </div>
    </div>

    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="bot_balance">Bottle Balance</label>
            <input id="bot_balance" name="bot_balance" placeholder=" " class="input-text js-input form-control shadow-none rounded-0" type="number" disabled required>
        </div>
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="pay_received">Payment Received</label>
          <input id="pay_received" name="pay_received"  class="input-text js-input form-control shadow-none" type="number" required>
        </div>

    </div>

    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="pay_balance">Payment Balance</label>
                <input id="pay_balance" name="pay_balance" placeholder=" " class="input-text js-input form-control shadow-none rounded-0" type="number"disabled required>
        </div>
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="contact">Mobile</label>
            <input id="contact" name="contact" class="input-text js-input form-control shadow-none" type="text" required>
        </div>
    </div>

    <div class="row">
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="date">Date</label>
            <input id="date" name="date" class="input-text js-input form-control shadow-none bg-white rounded-0" type="date">
        </div>
    
        <div class="form-field col-sm-4 mx-auto">
        <label class="label" for="ref_id">Reference ID</label>
        <input id="ref_id" name="ref_id" placeholder=" " class="input-text js-input form-control shadow-none" type="text" required>
        </div>
    </div>

    <div class="form-field col-sm-12 text-center">
        <input class="submit-btn btn btn-primary" type="submit" value="Save">
    </div>
    </form>
    </section>
</div>

<?php
    }else {
        header("Location:index.php");
    }
?>

  </div>

<script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
<script>
    document.getElementById('customer_name').addEventListener('change', function() {
    var selectedName = this.value;

    var dataArray = <?php echo json_encode($dataArray); ?>;
    for (var i = 0; i < dataArray.length; i++) {
        if (dataArray[i]['NAME'] === selectedName) {
            document.getElementById('customer_id').value = dataArray[i]['CLAINT_ID'];
            document.getElementById('rate').value = dataArray[i]['RATE'];
            document.getElementById('bot_balance').value = dataArray[i]['BOT_BAL'];
            document.getElementById('pay_balance').value = dataArray[i]['PAY_BAL'];
            document.getElementById('contact').value = dataArray[i]['MOBILE'];
            document.getElementById('ref_id').value = dataArray[i]['REF_ID'];

            // Add the not-empty class to the populated fields
            $('#customer_id, #rate, #bot_balance, #pay_balance, #contact, #ref_id').addClass('not-empty');
            
            break;
        }
    }
});

</script>
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