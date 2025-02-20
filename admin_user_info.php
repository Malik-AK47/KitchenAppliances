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

    </style>
    <title>User Information</title>
</head>

<body>
    <div class="container">
        <h2>User Information</h2>
        <?php
        include('../includes/db.php');

        // Function to display success or error messages
        function showMessage($message, $isError = false)
        {
            $class = $isError ? 'error' : 'success';
            echo "<p class='$class'>$message</p>";
        }

        // Display user information
        $userSql = "SELECT * FROM User";
        $userResult = mysqli_query($conn, $userSql);

        if (mysqli_num_rows($userResult) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Address</th></tr>";

            while ($userRow = mysqli_fetch_assoc($userResult)) {
                echo "<tr>";
                echo "<td>{$userRow['Id']}</td>";
                echo "<td>{$userRow['Name']}</td>";
                echo "<td>{$userRow['Email']}</td>";
                echo "<td>{$userRow['PhoneNumber']}</td>";
                echo "<td>{$userRow['Address']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            showMessage("No users found.");
        }
        ?>
    </div>
</body>

</html>
