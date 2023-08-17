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
          WHERE T.active ='1' and T.REF='Javed'";

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
<body>

<form method="POST" action="sales_ora.php" class="custom-form mx-auto mb-5 contact-form bg-white p-5 shadow">
    <h2 class="title text-center"><b>Sale Details</b></h2>

    <div class="form-field col-sm-4 mx-auto">
        <select id="customer_name" name="customer_name" class="input-text js-input form-control shadow-none rounded-0" required>
            <option value="" selected disabled>Select Customer Name</option>
            <?php
            while ($row = oci_fetch_assoc($stid)) {
                echo "<option value='" . $row['NAME'] . "'>" . $row['NAME'] . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- Fields to be populated based on selected customer -->
    <div class="form-field col-sm-4 mx-auto">
        <input id="customer_id" name="customer_id" placeholder="Customer ID" class="input-text js-input form-control shadow-none rounded-0" type="text" required>
    </div>
    <div class="form-field col-sm-4 mx-auto">
        <input id="rate" name="rate" placeholder="Rate" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
    </div>
    <div class="form-field col-sm-4 mx-auto">
        <input id="bot_balance" name="bot_balance" placeholder="Bot Balance" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
    </div>
    <div class="form-field col-sm-4 mx-auto">
        <input id="pay_balance" name="pay_balance" placeholder="Pay Balance" class="input-text js-input form-control shadow-none rounded-0" type="number" required>
    </div>
    <div class="form-field col-sm-4 mx-auto">
        <input id="mobile" name="mobile" placeholder="Mobile" class="input-text js-input form-control shadow-none" type="text" required>
    </div>
    <div class="form-field col-sm-4 mx-auto">
        <input id="ref_id" name="ref_id" placeholder="Ref ID" class="input-text js-input form-control shadow-none" type="text" required>
    </div>

    <div class="form-field col-sm-12 text-center">
        <input class="submit-btn btn btn-primary" type="submit" value="Save">
    </div>
</form>

<script>
    // Event listener for the customer name dropdown
    document.getElementById('customer_name').addEventListener('change', function() {
        var selectedName = this.value;

        <?php oci_execute($stid); ?>
        <?php while ($row = oci_fetch_assoc($stid)) { ?>
            if ("<?php echo $row['NAME']; ?>" === selectedName) {
                document.getElementById('customer_id').value = "<?php echo $row['CLAINT_ID']; ?>";
                document.getElementById('rate').value = "<?php echo $row['rate']; ?>";
                document.getElementById('bot_balance').value = "<?php echo $row['Bot_bal']; ?>";
                document.getElementById('pay_balance').value = "<?php echo $row['pay_bal']; ?>";
                document.getElementById('mobile').value = "<?php echo $row['mobile']; ?>";
                document.getElementById('ref_id').value = "<?php echo $row['ref_id']; ?>";
                break;
            }
        <?php } ?>
    });
</script>

</body>
