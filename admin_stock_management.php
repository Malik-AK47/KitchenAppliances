<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: #28a745;
            margin-top: 10px;
        }

        .error {
            color: #dc3545;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        td {
            background-color: #fff;
        }
    </style>
    <title>Stock Management</title>
</head>

<body>
    <div class="container">
        <h2>Stock Management</h2>

        <?php
        include('../includes/db.php');

        // Function to display success or error messages
        function showMessage($message, $isError = false)
        {
            $class = $isError ? 'error' : 'success';
            echo "<p class='$class'>$message</p>";
        }

        // Handle confirming the update
        if (isset($_POST['confirm_update_product'])) {
            $updateProductId = $_POST['update_product_id'];
            $updatedProductName = $_POST['updated_product_name'];
            $updatedProductPhoto = $_POST['updated_product_photo'];
            $updatedCostPrice = $_POST['updated_cost_price'];
            $updatedSellPrice = $_POST['updated_sell_price'];
            $updatedQuantity = $_POST['updated_quantity'];
            $updatedCategory = $_POST['updated_category'];
            $updatedDescription = $_POST['updated_description'];
            $updatedSupplierId = $_POST['updated_supplier_id'];

            // Calculate profit
            $updatedProfit = $updatedSellPrice - $updatedCostPrice;

            $updateProductSql = "UPDATE Product 
                         SET ProductName = '$updatedProductName', ProductPhoto = '$updatedProductPhoto', 
                             CostPrice = $updatedCostPrice, SellPrice = $updatedSellPrice, 
                             Profit = $updatedProfit, Quantity = $updatedQuantity, 
                             Description = '$updatedDescription', Category = '$updatedCategory', 
                             SupplierId = $updatedSupplierId
                         WHERE Id = $updateProductId";
            $updateProductResult = mysqli_query($conn, $updateProductSql);

            if ($updateProductResult) {
                showMessage("Product updated in the main catalog successfully!");
            } else {
                showMessage("Failed to update product in the main catalog. Please try again: " . mysqli_error($conn), true);
            }
        }


        // Handle deleting a product from the main catalog
        if (isset($_POST['delete_product'])) {
            $deleteProductId = isset($_POST['delete_product_id']) ? $_POST['delete_product_id'] : '';

            if (!empty($deleteProductId)) {
                $deleteProductSql = "DELETE FROM Product WHERE Id = $deleteProductId";
                $deleteProductResult = mysqli_query($conn, $deleteProductSql);

                if ($deleteProductResult) {
                    showMessage("Product deleted from the main catalog successfully!");
                } else {
                    showMessage("Failed to delete product from the main catalog. Please try again: " . mysqli_error($conn), true);
                }
            } else {
                showMessage("Product ID is missing.", true);
            }
        }

        // Add new product
        if (isset($_POST['add_product'])) {
            $productName = $_POST['product_name'];
            $productPhoto = $_POST['product_photo'];
            $sellPrice = $_POST['sell_price'];
            $costPrice = $_POST['cost_price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $supplierId = $_POST['supplier_id'];  // Added line to capture SupplierId

            $profit = $sellPrice - $costPrice;

            $addProductSql = "INSERT INTO Product (ProductName, ProductPhoto, CostPrice, SellPrice, Profit, Quantity, Description, Category, SupplierId) 
                      VALUES ('$productName', '$productPhoto', $costPrice, $sellPrice, $profit, $quantity, '$description', '$category', $supplierId)"; // Updated SQL query

            if (mysqli_query($conn, $addProductSql)) {
                showMessage("New product added successfully!");
            } else {
                showMessage("Error: " . mysqli_error($conn), true);
            }
        }

        ?>

        <!-- Add New Product Form -->
        <form id="add" action="admin_stock_management.php" method="post" style="display:none;">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required>

            <label for="product_photo">Product Photo URL:</label>
            <input type="text" name="product_photo" required>

            <label for="cost_price">Cost Price:</label>
            <input type="number" name="cost_price" required>

            <label for="sell_price">Sell Price:</label>
            <input type="number" name="sell_price" required>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" required>

            <label for="category">Category:</label>
            <input type="text" name="category" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <!-- New field for selecting the supplier -->
            <label for="supplier_id">Select Supplier:</label>
            <select name="supplier_id" required>
                <?php
                $supplierSql = "SELECT SupplierId, Name FROM Supplier";
                $supplierResult = mysqli_query($conn, $supplierSql);

                while ($supplierRow = mysqli_fetch_assoc($supplierResult)) {
                    echo "<option value='{$supplierRow['SupplierId']}'>{$supplierRow['Name']}</option>";
                }
                ?>
            </select>

            <button type="submit" name="add_product">Add Product</button>
        </form>

        <button onclick="showForm('add')">Add Product</button>
        <!-- Display Products -->
<table border="1">
    <tr>
        <th>Supplier Name</th>
        <th>Product Name</th>
        <th>Product Photo</th>
        <th>Cost Price</th>
        <th>Sell Price</th>
        <!-- <th>Profit</th> -->
        <th>Quantity</th>
        <th>Category</th>
        <!-- <th>Description</th> -->
        <th>Action</th>
    </tr>
    <?php
    $productSql = "SELECT s.Name AS SupplierName, p.Id, p.ProductName, p.ProductPhoto, p.CostPrice, p.SellPrice, p.Profit, p.Quantity, p.Category, p.Description 
    FROM Product p
    JOIN Supplier s ON p.SupplierId = s.SupplierId
    ORDER BY s.SupplierId"; // Order by SupplierId to group products by supplier


    $productResult = mysqli_query($conn, $productSql);

    $currentSupplier = null; // To track the current supplier

    while ($productRow = mysqli_fetch_assoc($productResult)) {
        if ($currentSupplier !== $productRow['SupplierName']) {
            // Start a new row for a new supplier
            echo "<tr>";
            echo "<td>{$productRow['SupplierName']}</td>";
            $currentSupplier = $productRow['SupplierName'];
        } else {
            // Skip the supplier name for subsequent products of the same supplier
            echo "<tr>";
            echo "<td></td>";
        }

// Display product information
echo "<td>{$productRow['ProductName']}</td>";
echo "<td>{$productRow['ProductPhoto']}</td>";
echo "<td>{$productRow['CostPrice']}</td>";
echo "<td>{$productRow['SellPrice']}</td>";
// echo "<td>{$productRow['Profit']}</td>";
echo "<td>{$productRow['Quantity']}</td>";
echo "<td>{$productRow['Category']}</td>";
// Removed the line below that displays the description
// echo "<td>{$productRow['Description']}</td>";
echo "<td>
        <form method='post' action=''>
            <input type='hidden' name='update_product_id' value='{$productRow['Id']}'>
            <button type='submit' name='update_product'>Update</button>
        </form>
        <form method='post' action='' class='delete-form'>
            <input type='hidden' name='delete_product_id' value='{$productRow['Id']}'>
            <button type='submit' name='delete_product'>Delete</button>
        </form>
    </td>";
echo "</tr>";

    }
    ?>
</table>

        <!-- Dynamic Update Form -->
        <?php
        if (isset($_POST['update_product'])) {
            $updateProductId = $_POST['update_product_id'];
            // Fetch existing product details along with supplier information
            $getProductDetailsSql = "SELECT 
                                p.Id, p.ProductName, p.ProductPhoto, p.CostPrice, p.SellPrice, 
                                p.Quantity, p.Description, p.Category, p.SupplierId, s.Name AS SupplierName
                            FROM Product p
                            LEFT JOIN Supplier s ON p.SupplierId = s.SupplierId
                            WHERE p.Id = $updateProductId";
            $getProductDetailsResult = mysqli_query($conn, $getProductDetailsSql);
            $existingProductDetails = mysqli_fetch_assoc($getProductDetailsResult);

            echo "<h3>Update Product</h3>";
            echo "<form method='post' action=''>
                    <input type='hidden' name='update_product_id' value='{$existingProductDetails['Id']}'>
                    Product Name: <input type='text' name='updated_product_name' value='{$existingProductDetails['ProductName']}'><br>
                    Product Photo: <input type='text' name='updated_product_photo' value='{$existingProductDetails['ProductPhoto']}'><br>
                    Cost Price: <input type='text' name='updated_cost_price' value='{$existingProductDetails['CostPrice']}'><br>
                    Sell Price: <input type='text' name='updated_sell_price' value='{$existingProductDetails['SellPrice']}'><br>
                    Quantity: <input type='text' name='updated_quantity' value='{$existingProductDetails['Quantity']}'><br>
                    Category: <input type='text' name='updated_category' value='{$existingProductDetails['Category']}'><br>
                    Description: <input type='text' name='updated_description' value='{$existingProductDetails['Description']}'><br>
                    Supplier: 
                    <select name='updated_supplier_id'>";

                // Fetch the list of suppliers
                $getSuppliersSql = "SELECT SupplierId, Name FROM Supplier";
                $getSuppliersResult = mysqli_query($conn, $getSuppliersSql);

                // Display the current supplier as selected
                while ($supplierRow = mysqli_fetch_assoc($getSuppliersResult)) {
                    $selected = ($supplierRow['SupplierId'] == $existingProductDetails['SupplierId']) ? 'selected' : '';
                    echo "<option value='{$supplierRow['SupplierId']}' $selected>{$supplierRow['Name']}</option>";
                }

            echo "</select><br>
            <input type='submit' name='confirm_update_product' value='Confirm Update'>
        </form>";

            // Show update form when the user clicks
        }
        ?>



        <script>
            function showForm(formId) {
                document.getElementById(formId).style.display = 'block';
            }
        </script>

    
    </div>
</body>

</html>