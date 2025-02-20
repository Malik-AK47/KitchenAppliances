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
        }

        .container {
            width: 80%;
            max-width: 800px;
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

        .dashboard-menu {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-menu li {
            margin-bottom: 15px;
        }

        .dashboard-menu a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: block;
            padding: 15px;
            border-radius: 8px;
            background-color: #f4f4f4;
            transition: background-color 0.3s ease, color 0.3s ease;
            border: 1px solid #ddd; /* Add border to each link */
        }

        .dashboard-menu a:hover {
            background-color: #e0e0e0;
            color: #0056b3;
        }
    </style>
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <ul class="dashboard-menu">
            <li><a href="admin_stock_management.php">Stock Management</a></li>
            <li><a href="admin_user_info.php">User Information</a></li>
            <li><a href="admin_purchase_history.php">Sell History</a></li>
            <li><a href="admin_repair_requests.php">Repair Requests</a></li>
            <li><a href="supplier_info.php">Supplier Information</a></li>
            <!-- <li><a href="supplier_registration.php">Add Supplier</a></li> -->
        </ul>
    </div>
</body>

</html>
