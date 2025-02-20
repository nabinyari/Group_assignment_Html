<?php
// Start session
session_start();

// Database connection
include("config.php");

// Get form data
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$confirmPassword = trim($_POST["confirmPassword"]);

// Validate passwords
if ($password !== $confirmPassword) {
    header("Location: index.php?message=Error: Passwords do not match.&type=error");
    exit();
}

// Check if email exists
$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Compare passwords (without hashing)
    if ($password !== $user["password"]) {
        header("Location: index.php?message=Error: Incorrect password.&type=error");
        exit();
    }

    // Insert gift card purchase
    $amount = 50.00; // Fixed amount
    $stmt = $conn->prepare("INSERT INTO gift_card (email_id, amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $email, $amount);

    if ($stmt->execute()) {
        header("Location: gift_card.html?message=Success! Gift Card Purchased.&type=success");
    } else {
        header("Location: gift_card.html?message=Error: Purchase failed.&type=error");
    }
} else {
    header("Location: gift_card.html?message=Error: Email not found in database.&type=error");
}

exit();
?>
