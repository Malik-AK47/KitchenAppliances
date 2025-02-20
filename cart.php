<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Shopping Cart</title>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .container {
        width: 60%;
        max-width: 1200px;
        background-color: #fff;
        padding: 30px;
        margin: 20px auto;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 30px;
        padding: 20px;
        /* border: 1px solid #e0e0e0; */
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    /* li:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        } */

    img {
        width: 450px;
        height: 400px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    h3 {
        margin-top: 0px;
        color: #007bff;
        margin-bottom: 10px;
    }

    p {
        color: #555;
        margin-bottom: 20px;
    }

    .cart-item-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-item-action button {
        width: 200px;
        background-color: #007bff;
        color: #fff;
        padding: 15px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .cart-item-action button:hover {
        background-color: #0056b3;
    }

    .empty-cart {
        text-align: center;
        color: #555;
    }

    .btns {
        padding-top: 20px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 0;
    }
</style>

<body>
    <div class="container">
        <h2>Shopping Cart</h2>
        <?php
        include('../includes/db.php');
        session_start();

        // Handle Add to Cart action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
            $productId = $_POST['product_id'];

            // Add product to cart (session)
            $_SESSION['cart'][$productId] = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] + 1 : 1;
        }

        // Handle Remove from Cart action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'remove_from_cart') {
            $productId = $_POST['product_id'];

            // Remove product from cart (session)
            if (isset($_SESSION['cart'][$productId])) {
                if ($_SESSION['cart'][$productId] > 1) {
                    $_SESSION['cart'][$productId]--;
                } else {
                    unset($_SESSION['cart'][$productId]);
                }
            }
        }

        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        // Display cart items
        // Display cart items
        if (!empty($cartItems)) {
            echo "<ul>";
            foreach ($cartItems as $productId => $quantity) {
                // Retrieve product details from the database
                $productSql = "SELECT * FROM Product WHERE Id = $productId";
                $productResult = mysqli_query($conn, $productSql);

                // Check if the product exists before attempting to fetch details
                if ($productResult && mysqli_num_rows($productResult) > 0) {
                    $productRow = mysqli_fetch_assoc($productResult);

                    // Display cart item with Remove and Purchase buttons
                    echo "<li>";
                    echo "<img src='{$productRow['ProductPhoto']}' alt='{$productRow['ProductName']}'>";
                    echo "<h3>{$productRow['ProductName']}</h3>";
                    echo "<p>Price: $ {$productRow['SellPrice']}</p>";
                    echo "<p>Description: {$productRow['Description']}</p>";

                    echo "<div class='btns'>";
                    // Remove from Cart button
                    echo "<form action='cart.php' method='post' class='cart-item-action'>";
                    echo "<input type='hidden' name='product_id' value='{$productRow['Id']}'>";
                    echo "<input type='hidden' name='action' value='remove_from_cart'>";
                    echo "<button type='submit'>Remove from Cart</button>";
                    echo "</form>";

                    // Purchase button
                    echo "<form action='purchase.php' method='post' class='cart-item-action'>";
                    echo "<input type='hidden' name='product_id' value='{$productRow['Id']}'>";
                    echo "<input type='hidden' name='action' value='purchase'>";
                    echo "<button type='submit'>Purchase</button>";
                    echo "</div>";
                    echo "</form>";

                    echo "</li>";
                }
                // else {
                //     // Handle the case where the product details couldn't be retrieved
                //     echo "<li>Product details not available.</li>";
                // }
            }
            echo "</ul>";
        } else {
            echo "Your cart is empty.";
        }
        ?>
    </div>
</body>

</html>