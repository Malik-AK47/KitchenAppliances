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
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
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
    </style>
    <title>Admin Login</title>
</head>

<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php
        include('../includes/db.php');

        if (isset($_POST['admin_login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $adminSql = "SELECT * FROM Admin WHERE Email = '$email' AND Password = '$password'";
            $adminResult = mysqli_query($conn, $adminSql);

            if (mysqli_num_rows($adminResult) == 1) {
                echo "Admin login successful!";
                header("Location: admin_dashboard.php");
            } else {
                echo "Invalid email or password for admin.";
            }
        }
        ?>

        <form action="admin_login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="admin_login">Admin Login</button>
        </form>
    </div>
</body>

</html>