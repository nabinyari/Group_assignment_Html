<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="g_style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Card</title>
</head>
<body>
    <div class="checkout-form">
        <p>---------> mpn <---------</p>
        <h2>Welcome to purchase <b><i>Gift Card</i></b></h2>
        
        <form id="checkoutForm" action="checkout.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="bank">Bank Account Number:</label>
            <input type="text" id="bank" name="bank" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
    
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
    
            <button type="submit">Complete Purchase</button>
        </form>
    </div>

    <!-- Pop-up message container -->
    <div id="popupMessage" class="popup">
        <p id="popupText"></p>
        <button onclick="closePopup()">OK</button>
    </div>

    <script>
        // Function to show popups
        function showPopup(message, isSuccess) {
            var popup = document.getElementById("popupMessage");
            var popupText = document.getElementById("popupText");

            popupText.textContent = message;
            popup.style.display = "block";

            // Style popup based on success/error
            popup.style.backgroundColor = isSuccess ? "#d4edda" : "#f8d7da";
            popup.style.color = isSuccess ? "#155724" : "#721c24";
        }

        // Function to close popups
        function closePopup() {
            document.getElementById("popupMessage").style.display = "none";
        }

        // Check for PHP session messages
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("message")) {
                showPopup(urlParams.get("message"), urlParams.get("type") === "success");
            }
        };
    </script>
</body>
</html>
