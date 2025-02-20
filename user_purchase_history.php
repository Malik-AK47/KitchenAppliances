<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>User Purchase History</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
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
            background-color: #ddd;
        }
    </style>
<body>
    <div class="container">
        <h2>User Purchase History</h2>
        <?php
        include('../includes/db.php');
        session_start();
        
        // Retrieve user's purchase history from the database
        $userId = $_SESSION['user_id']; // Assuming you have a session variable for user_id after login
        $userPurchaseHistorySql = "SELECT Purchase.PurchaseDate, Purchase.ProductName, 
                                    Purchase.CustomerName, Purchase.Email, Purchase.PhoneNumber, 
                                    Purchase.Address, Purchase.PurchaseValue 
                                    FROM Purchase 
                                    JOIN Product ON Purchase.ProductName = Product.ProductName
                                    WHERE Purchase.UserId = $userId"; // Corrected column name
        $userPurchaseHistoryResult = mysqli_query($conn, $userPurchaseHistorySql);

        if (mysqli_num_rows($userPurchaseHistoryResult) > 0) {
            echo "<table>";
            echo "<tr><th>Date</th><th>Product Name</th><th>Buyer Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Price</th></tr>";
            while ($row = mysqli_fetch_assoc($userPurchaseHistoryResult)) {
                echo "<tr>";
                echo "<td>{$row['PurchaseDate']}</td>";
                echo "<td>{$row['ProductName']}</td>";
                echo "<td>{$row['CustomerName']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['PhoneNumber']}</td>";
                echo "<td>{$row['Address']}</td>";
                echo "<td>$ {$row['PurchaseValue']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No purchase history available for the user.";
        }
        ?>
    </div>
</body>

</html>
