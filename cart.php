<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "mpn");

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

// Add to Cart
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_name"])) {
    if (!isset($_SESSION["user_id"])) {
        echo json_encode(["success" => false, "message" => "Please log in first!"]);
        exit;
    }

    $user_id = $_SESSION["user_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];

    // Check if product exists in cart
    $check_sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_name = '$product_name'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_name = '$product_name'";
        mysqli_query($conn, $update_sql);
    } else {
        $insert_sql = "INSERT INTO cart (user_id, product_name, price, quantity) VALUES ('$user_id', '$product_name', '$price', 1)";
        mysqli_query($conn, $insert_sql);
    }

    echo json_encode(["success" => true]);
    exit;
}

// Fetch Cart Count
if (isset($_GET["cart_count"])) {
    if (!isset($_SESSION["user_id"])) {
        echo "0";
        exit;
    }

    $user_id = $_SESSION["user_id"];
    $result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM cart WHERE user_id = '$user_id'");
    $row = mysqli_fetch_assoc($result);
    echo $row["count"];
    exit;
}
?>
