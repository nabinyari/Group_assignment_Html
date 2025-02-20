<?php
include 'config.php';
$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    }
     else 
     {
        $sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $message = "Registered successfully!";
            $message_type = "success";
        } else {
            $message = "Registration failed. Please try again.";
            $message_type = "error";
        }
    }
}
?>