<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include_once "db_sql.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "All fields are required";
        header("Location: index.php");
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['auth'] = true;
            header("Location: form.php");
            exit();
        } else {
            $_SESSION['error_message']= "Invalid login details";
            header("Location: index.php");

        }
    } 
    else{
        $_SESSION['error_message'] = "Invalid login details";
        header("Location: index.php");
    }


}
?>

