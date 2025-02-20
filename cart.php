<?php
session_start();
include 'config.php';  // Connect to database

// Add to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];

    $_SESSION['cart'][] = ['item_name' => $item_name, 'price' => $price];
    header("Location: cart.php");
    exit();
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

// Checkout (Place Order)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $user_id = 1;  // Example user ID, replace with dynamic login user ID

    foreach ($_SESSION['cart'] as $item) {
        $item_name = $item['item_name'];
        $price = $item['price'];
        $query = "INSERT INTO orders (user_id, item_name, price) VALUES ('$user_id', '$item_name', '$price')";
        mysqli_query($conn, $query);
    }

    unset($_SESSION['cart']);
    header("Location: orders.php");
    exit();
}
?>

<!-- Cart Display -->
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - MPN</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <h1>Your Shopping Cart</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <li>
                    <?= htmlspecialchars($item['item_name']) ?> - €<?= htmlspecialchars($item['price']) ?>
                    <a href="cart.php?remove=<?= $index ?>">Remove</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <form method="post">
            <button type="submit" name="checkout">Checkout</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <a href="index11.html">← Continue Shopping</a>
</body>
</html>
