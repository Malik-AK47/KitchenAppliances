<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px; /* Adjust the max-width as needed */
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .product-details h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .product-details p {
            color: #555;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .product-details form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .product-details button {
            width: 200px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-details button:hover {
            background-color: #0056b3;
        }
        .product-details .btns {
            display: flex;
            justify-content: space-evenly;
        }
    </style>
    <title>Product Details</title>
</head>

<body>
    <div class="container">
        <?php
        include('../includes/db.php');
        session_start();

        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];

            $productSql = "SELECT * FROM Product WHERE Id = $productId";
            $productResult = mysqli_query($conn, $productSql);

            if (mysqli_num_rows($productResult) > 0) {
                $productRow = mysqli_fetch_assoc($productResult);

                echo "<div class='product-details'>";
                echo "<img src='{$productRow['ProductPhoto']}' alt='{$productRow['ProductName']}'>";
                echo "<h2>{$productRow['ProductName']}</h2>";
                echo "<p>{$productRow['Description']}</p>";
                echo "<h4>{$productRow['SellPrice']}</h4>";

                echo "<div class='btns'>";
                // Add to Cart button
                echo "<form action='cart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='{$productRow['Id']}'>";
                echo "<input type='hidden' name='action' value='add_to_cart'>";
                echo "<button type='submit'>Add to Cart</button>";
                echo "</form>";

                // Purchase button
                echo "<form action='purchase.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='{$productRow['Id']}'>";
                echo "<input type='hidden' name='action' value='purchase'>";
                echo "<button type='submit'>Purchase</button>";
                echo "</div>";
                echo "</form>";

                echo "</div>";
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Invalid product ID.";
        }
        ?>
    </div>
</body>

</html>
