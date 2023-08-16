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

//echo "Connected to Oracle Database!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "All fields are required";
        header("Location: index.php");
        exit();
    }

    // Oracle-specific: Construct the SQL statement
    $sql = "SELECT * FROM country_master WHERE email = :email";

    // Prepare the statement
    $stmt = oci_parse($conn, $sql);

    // Bind the parameters
    oci_bind_by_name($stmt, ':email', $email);

    // Execute the statement
    $result = oci_execute($stmt);

    if ($result) {
        $row = oci_fetch_assoc($stmt);
        if ($row) {
            $storedPassword = $row["PASSWORD"]; 
            if ($password === $storedPassword) {
                $_SESSION['auth'] = true;
                echo "Connected to Oracle Database2!";
                header("Location: form.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid login details";
                echo "Connected to Oracle Databasssse!";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Invalid login details";
            echo "Connected to Oraclewerwerr Database!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Error executing query";
        echo "Connected to Oracle Database!wew";
        header("Location: index.php");
        exit();
    }

    // Free the statement
    oci_free_statement($stmt);

    oci_close($conn); // Close Oracle connection
}
?>
