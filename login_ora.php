<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "db_ora.php"; // Include your Oracle database connection file

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
            $hashedPassword = $row["PASSWORD"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['auth'] = true;
                header("Location: form.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid login details";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Invalid login details";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Error executing query";
        header("Location: index.php");
        exit();
    }

    // Free the statement
    oci_free_statement($stmt);

    oci_close($conn); // Close Oracle connection
}
?>
