<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        header {
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #5c43fa;
            padding: 10px 0;
            color: white;
            text-align: center;
        }

        .navbar {
            background-color: #060508;
            overflow: hidden;
            display: flex;
            justify-content: space-around;
            text-align: center;
            align-items: center;
            width: 100%;
            height: 60px;
        }

        .navbar a {
            float: left;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .container {
            width: 90%;
            background-color:  white;
            color: white;
            padding: 20px;
            margin: 30px auto;
            border-radius: 8px;
            border: grey;
            box-shadow: 1px 1px 2px grey;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            margin-top: 0px;
        }

        .product-summary {
            width: 23%;
            margin-right: 2%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1), 0 0 20px rgba(0, 0, 0, 0.1), 0 0 25px rgba(0, 0, 0, 0.1); */
            box-sizing: border-box;
            float: left;
            margin-bottom: 20px;
            background-color: white;
            color: white;
        }

        .product-summary img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .product-summary h3 {
            color: #333;
            margin-bottom: 8px;
        }

        .product-summary p {
            color: black;
            margin-bottom: 12px;
        }

        .product-summary a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .product-summary a:hover {
            background-color: #0056b3;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .login-dropdown {
            float: right;
        }

        .login-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .login-dropdown:hover .login-dropdown-content {
            display: block;
        }

        .login-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .login-dropdown-content a:hover {
            background-color: #5c43fa;
            color: white;
        }
    </style>

    <title>Product Catalog</title>
</head>

<body>
    <header>
        <h1>VARMA KITCHEN APPLIANCES </h1>
    </header>

    <div class="navbar">
        <!-- <div class="login-dropdown">
            <a href="#">Login &#9662;</a>
            <div class="login-dropdown-content">
                <a href="login.php">User Login</a>
                <a href="supplier_login.php">Supplier Login</a>
            </div>
        </div> -->
        <a href="login.php">Login</a>
        <a href="cart.php">Cart</a>
        <a href="user_purchase_history.php">Shopping</a>
        <a href="repair_product.php">Repair</a>
        <!-- <a href="supplier_login.php">Supplier</a> -->
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        

        <?php
        include('../includes/db.php');

        // Fetch distinct categories for filter
        $categorySql = "SELECT DISTINCT Category FROM Product";
        $categoryResult = mysqli_query($conn, $categorySql);

        // Display category filter
        echo "<label for='category_filter'>Filter by Category:</label>";
        echo "<select id='category_filter' onchange='filterProducts()'>";
        echo "<option value='all'>All Categories</option>";

        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
            echo "<option value='{$categoryRow['Category']}'>{$categoryRow['Category']}</option>";
        }

        echo "</select>";

        // Display products
        $productSql = "SELECT Id, ProductName, ProductPhoto, SellPrice, LEFT(Description, 100) as ShortDescription, Category FROM Product";
        $productResult = mysqli_query($conn, $productSql);

        if (mysqli_num_rows($productResult) > 0) {
            while ($productRow = mysqli_fetch_assoc($productResult)) {
                echo "<div class='product-summary' data-category='{$productRow['Category']}'>";
                echo "<img src='{$productRow['ProductPhoto']}' alt='{$productRow['ProductName']}'>";
                echo "<h3>{$productRow['ProductName']}</h3>";
                echo "<p>{$productRow['ShortDescription']}...</p>";
                echo "<a href='product_details.php?product_id={$productRow['Id']}'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>
        
    <script>
        function filterProducts() {
            var categoryFilter = document.getElementById('category_filter').value;
            var productSummaries = document.querySelectorAll('.product-summary');

            productSummaries.forEach(function(summary) {
                var category = summary.getAttribute('data-category');

                if (categoryFilter === 'all' || category === categoryFilter) {
                    summary.style.display = 'block';
                } else {
                    summary.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>