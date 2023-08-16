<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "db_connection.php";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        die("All fields are required.");
    }

    if ($password !== $cpassword) {
        die("Passwords do not match.");
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['auth'] = TRUE;
        header("location: index.php");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
