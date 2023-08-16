<?php
session_start();
?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="jquery-ui.css">
  <link rel="stylesheet" href="includes/style.css">
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
          })
            </script>";
      unset($_SESSION['success_message']);
    }
    ?>
    <div class="container mt-4">
  <section>
    <h2 class="title text-center">Add Sale Details</h2>
    <form method="POST" action="includes/saleDetails.php" class="custom-form  mx-auto mb-5 contact-form bg-white p-5 shadow">
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="customer_id" name="customer_id" class="input-text js-input form-control shadow-none rounded-0" type="text" required>
          <label class="label" for="customer_id">Customer ID</label>
        </div>
        <div class="form-field col-sm-4 mx-auto">
          <input id="name" name="customers_name" class="input-text js-input form-control shadow-none rounded-0" type="text" required>
          <label class="label" for="name">Customer's Name</label>
        </div>
      </div>
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="quantity" name="quantity" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <label class="label" for="quantity">Quantity</label>
        </div>
        <div class="form-field col-sm-4 mx-auto">
          <input id="rate" name="rate" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <label class="label" for="rate">Rate</label>
        </div>
      </div>
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="BotRecord" name="bot_rec" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <label class="label" for="BotRecord">Pay Balance</label>
        </div>
        <div class="form-field col-sm-4 mx-auto">
          <input id="bottle_balance" name="bottle_balance" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
          <label class="label" for="bottle_balance">Bot Balance</label>
        </div>
      </div>
      <div class="row">
        <div class="form-field col-sm-4 mx-auto">
          <input id="amount" name="amount" class="input-text js-input form-control shadow-none bg-white rounded-0" type="text" disabled required>
          <label class="label" for="amount" style="top: -19px">Amount</label>
        </div>
        <div class="form-field col-sm-4 mx-auto">
          <input id="payReceived" name="pay_received" class="input-text js-input form-control shadow-none" type="number" required>
          <label class="label" for="payReceived">Pay Received</label>
        </div>
      </div>
      <div class="row">
            <?php
        $formattedDate = date('Y-m-d');
        ?>
        <div class="form-field col-sm-4 mx-auto">
          <input id="date" name="date" value="<?php echo $formattedDate; ?>" class="input-text js-input form-control shadow-none bg-white rounded-0" type="text" disabled required>
          <label class="label" for="date" style="top: -19px">Date</label>
        </div>
        <div class="col-sm-4 mx-auto"></div>
      </div>
      <div class="form-field col-sm-12 text-center">
        <input class="submit-btn btn btn-primary" type="submit" value="Save">
      </div>
    </form>
  </section>
</div>

  </div>
  <script src="jquery.js"></script>
  <script src="jquery-ui.js"></script>
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