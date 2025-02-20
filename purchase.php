<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Purchase</title>
</head>
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
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .product-details {
            text-align: center;
            margin-bottom: 30px;
        }

        .product-details img {
            margin-top: 0;
            max-width: 100%;
            height: 380px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-details h3 {
            color: #333;
            margin-bottom: 10px;
            margin-top: 0;
        }

        .product-details p {
            color: #555;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
</style>
<body>
    <div class="container">
        <h2>Product Purchase</h2>
        <?php
        include('../includes/db.php');
        session_start();

        // Handle Purchase action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'purchase') {
            $productId = $_POST['product_id'];

            // Retrieve product details from the database
            $productSql = "SELECT * FROM Product WHERE Id = $productId";
            $productResult = mysqli_query($conn, $productSql);

            if (mysqli_num_rows($productResult) > 0) {
                $productRow = mysqli_fetch_assoc($productResult);

                // Display the selected product details
                echo "<div class='product-details'>";
                echo "<img src='{$productRow['ProductPhoto']}' alt='{$productRow['ProductName']}'>";
                echo "<h3>{$productRow['ProductName']}</h3>";
                echo "<p>Price: $ {$productRow['SellPrice']}</p>";
                echo "</div>";

                // Display the purchase form
                echo "<form action='process_purchase.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='{$productRow['Id']}'>";
                echo "<input type='hidden' name='product_name' value='{$productRow['ProductName']}'>";
                echo "<input type='hidden' name='sell_price' value='{$productRow['SellPrice']}'>";

                echo "<label for='customer_name'>Your Name:</label>";
                echo "<input type='text' name='customer_name' required>";

                echo "<label for='email'>Email:</label>";
                echo "<input type='email' name='email' required>";

                echo "<label for='phone_number'>Phone Number:</label>";
                echo "<input type='text' name='phone_number' required>";

                echo "<label for='address'>Address:</label>";
                echo "<textarea name='address' rows='4' required></textarea>";

                echo "<button type='submit'>Complete Purchase</button>";
                echo "</form>";
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Invalid purchase request.";
        }
        ?>
    </div>
</body>

</html>
