<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['users'] = $email;
            header("Location: index11.html");
            exit();
        } else {
            echo "<script>alert('Error: Email not found. Enter valid email and password! ');</script>";
        }
    } else {
        echo "<script>alert('Email and password cannot be empty.');</script>";
    }
}

$conn->close();
?>
