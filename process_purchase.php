<?php
include('../includes/db.php');
session_start();

// Handle Purchase process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $sellPrice = $_POST['sell_price'];
    $customerName = $_POST['customer_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $address = $_POST['address'];
    $userId = $_SESSION['user_id']; // Assuming you have a session variable for user_id after login

    // Process the purchase and insert into the database
    $purchaseDate = date('Y-m-d');
    $purchaseValue = $sellPrice; // Set the initial value as the product's sell price

    // Insert purchase record into the database
    $insertPurchaseSql = "INSERT INTO Purchase (PurchaseDate, PurchaseValue, ProductName, CustomerName, Email, PhoneNumber, Address, UserId) 
                          VALUES ('$purchaseDate', $purchaseValue, '$productName', '$customerName', '$email', '$phoneNumber', '$address', $userId)";
    $insertPurchaseResult = mysqli_query($conn, $insertPurchaseSql);

    if ($insertPurchaseResult) {
        echo "<p>Thank you, $customerName, for your purchase of '$productName'! Total value: $ {$purchaseValue}</p>";

        // Update the quantity of the purchased product in the Product table
        $updateQuantitySql = "UPDATE Product SET Quantity = Quantity - 1 WHERE Id = $productId AND Quantity > 0";
        $updateQuantityResult = mysqli_query($conn, $updateQuantitySql);

        if (!$updateQuantityResult) {
            echo "Failed to update product quantity. Please contact support.";
        }
    } else {
        echo "Failed to process the purchase. Please try again.";
    }
} else {
    echo "Invalid purchase request.";
}
?>
