<?php
session_start();
include 'config.php';

$user_id = 1;  // Replace with dynamic user ID from login session

// Handle return request
if (isset($_POST['return'])) {
    $order_id = $_POST['order_id'];
    $query = "UPDATE orders SET status='Returned' WHERE id='$order_id' AND user_id='$user_id'";
    mysqli_query($conn, $query);
}

// Fetch user orders
$result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id='$user_id'");

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders - MPN</title>
    <link rel="stylesheet" href="order.css">
</head>
<body>
    <h1>My Orders</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <li>
                    <?= htmlspecialchars($row['item_name']) ?> - €<?= htmlspecialchars($row['price']) ?>
                    | Status: <?= htmlspecialchars($row['status']) ?>

                    <?php if ($row['status'] === 'Ordered'): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="return">Request Return</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <a href="index11.html">← Back to Shopping</a>
</body>
</html>
