<?php
include('../includes/db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $shopName = $_POST['shopName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // $password = $_POST['password'];

    $insertSupplierSql = "INSERT INTO Supplier (Name, ShopName, Email, PhoneNo) VALUES ('$name', '$shopName', '$email', '$phone')";
    $insertSupplierResult = mysqli_query($conn, $insertSupplierSql);

    if ($insertSupplierResult) {
        echo "Supplier added successfully!";
        // You can redirect to the supplier login page or display a login link here
    } else {
        echo "Failed to add supplier. Please try again.";
    }
}
?>
<?php
// include('../includes/db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $shopName = $_POST['shopName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // $password = $_POST['password'];

    $insertSupplierSql = "INSERT INTO Supplier (Name, ShopName, Email, PhoneNo) VALUES ('$name', '$shopName', '$email', '$phone')";
    $insertSupplierResult = mysqli_query($conn, $insertSupplierSql);

    if ($insertSupplierResult) {
        echo "Supplier added successfully!";
        // You can redirect to the supplier login page or display a login link here
    } else {
        echo "Failed to add supplier. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            margin: 30px auto;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Add Supplier</title>
</head>

<body>
    <div class="container">
        <h2>Supplier Registration</h2>
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>

            <label for="name">Shop Name:</label>
            <input type="text" name="shopName" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>

            <!-- <label for="password">Password:</label>
            <input type="password" name="password" required><br> -->

            <input class="button" type="submit" name="register" value="Register">
        </form>
    </div>
</body>

</html>