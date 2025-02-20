<?php
include('../includes/db.php');
session_start();

function showMessage($message, $isError = false)
{
    $class = $isError ? 'error' : 'success';
    echo "<p class='$class'>$message</p>";
}

if (isset($_POST['register'])) {
    if ($_POST['action'] == 'add_supplier') {
        echo "<script>window.onload = function() { document.getElementById('supplierForm').style.display = 'block'; }</script>";
    } elseif ($_POST['action'] == 'register') {
        $name = $_POST['name'];
        $shopName = $_POST['shopName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $insertSupplierSql = "INSERT INTO Supplier (Name, ShopName, Email, PhoneNo) VALUES ('$name', '$shopName', '$email', '$phone')";
        $insertSupplierResult = mysqli_query($conn, $insertSupplierSql);

        if ($insertSupplierResult) {
            echo "<script>";
            echo "alert('Supplier added successfully!')";
            echo "</script>";
        } else {
            showMessage("Failed to add supplier. Please try again.");
        }
    }
}

?>

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

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 400px;
            /* max-width: 800px; */
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container1 {
            width: 65%;
            /* max-width: 800px; */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        .error {
            color: #dc3545;
            margin-top: 10px;
        }

        .success {
            color: #28a745;
            margin-top: 10px;
        }

        .close-btn {
            position: absolute;
            top: 98px;
            right: 550px;
            font-size: 50px;
            cursor: pointer;
            color: black;
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

        .add {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add:hover {
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
    </style>
    <title>Supplier Information</title>
</head>

<body>
    <div class="container1">
        <h2>Supplier Information</h2>
        <button onclick="showForm('supplierForm')">Add Supplier</button>

        <?php
        // Display user information
        $userSql = "SELECT * FROM supplier";
        $userResult = mysqli_query($conn, $userSql);

        if (mysqli_num_rows($userResult) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>ShopName</th><th>Email</th><th>Phone Number</th></tr>";

            while ($userRow = mysqli_fetch_assoc($userResult)) {
                echo "<tr>";
                echo "<td>{$userRow['SupplierId']}</td>";
                echo "<td>{$userRow['Name']}</td>";
                echo "<td>{$userRow['ShopName']}</td>";
                echo "<td>{$userRow['Email']}</td>";
                echo "<td>{$userRow['PhoneNo']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            showMessage("No users found.");
        }
        ?>
    </div>

    <!-- Supplier Registration Form -->
    <div class="overlay" id="overlay">
        <div class="container" id="supplierForm">
            <span onclick="hideForm()" class="close-btn">&times;</span>
            <h2>Add Supplier</h2>
            <form method="post" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" required><br>

                <label for="name">Shop Name:</label>
                <input type="text" name="shopName" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" required><br>

                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" required>

                <input type="hidden" name="action" value="register">

                <input class="add" class="button" type="submit" name="register" value="Add">
            </form>
        </div>
    </div>

    <script>
        function showForm(formId) {
            document.getElementById('overlay').style.display = 'flex';
            document.getElementById(formId).style.display = 'block';
        }

        function hideForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('supplierForm').style.display = 'none';
        }
    </script>
</body>

</html>
