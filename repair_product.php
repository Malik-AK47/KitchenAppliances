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
            width: 75%;
            background-color: #fff;
            padding: 30px;
            margin: 30px auto;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            top: -90px;
            left: -9px;
            right: -88px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: none;
            /* Initially hidden */
            width: 400px;
            flex-direction: column;
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
            /* Ensure form is above other content */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input,
        textarea,
        select {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        #showRepairForm {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 33px;
            right: 30px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
            /* Add margin to separate button from table */
        }

        button:hover {
            background-color: #0056b3;
        }

        .overlay {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black background */
            z-index: 998;
            /* Ensure overlay is below form */
        }

        /* Style for success and error messages */
        .success {
            color: #28a745;
            margin-top: 10px;
        }

        .error {
            color: #dc3545;
            margin-top: 10px;
        }

        /* Style for repair request table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            border: 1px solid #ddd;
            padding: 8px;
            height: 50px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            height: 30px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <title>Repair Product</title>
</head>

<body>
    <div class="container">
        <?php
        include('../includes/db.php');
        session_start();

        function showMessage($message, $isError = false)
        {
            $class = $isError ? 'error' : 'success';
            echo "<p class='$class'>$message</p>";
        }


        if (isset($_POST['submit_request'])) {
            $name = $_POST['name'];
            $phone = $_POST['phoneno'];
            $productName = $_POST['productname'];
            $description = $_POST['description'];

            // Retrieve the current date from the hidden input
            $requestDate = $_POST['request_date'];

            // Retrieve the user ID from the session
            $userId = $_SESSION['user_id'];

            $insertRequestSql = "INSERT INTO Repair (name, phoneno, productname, description, request_date, user_id)
                                VALUES ('$name', '$phone', '$productName', '$description', '$requestDate', '$userId')";

            if (mysqli_query($conn, $insertRequestSql)) {
                showMessage("Repair request submitted successfully!");
            } else {
                showMessage("Error: " . mysqli_error($conn), true);
            }
        }



        // Display user's requested products for repair
        $userId = $_SESSION['user_id'];
        $repairSql = "SELECT * FROM Repair WHERE user_id = $userId";
        $repairResult = mysqli_query($conn, $repairSql);

        if (mysqli_num_rows($repairResult) > 0) {
            echo "<h3>Requested Products for Repair:</h3>";
            echo "<table>";
            echo "<tr><th>Requested Date</th><th>Name</th><th>Phone Number</th><th>Product Name</th><th>Description</th><th>Status</th></tr>";

            while ($repairRow = mysqli_fetch_assoc($repairResult)) {
                echo "<tr>";
                echo "<td>{$repairRow['request_date']}</td>";
                echo "<td>{$repairRow['name']}</td>";
                echo "<td>{$repairRow['phoneno']}</td>";
                echo "<td>{$repairRow['productname']}</td>";
                echo "<td>{$repairRow['description']}</td>";
                echo "<td>{$repairRow['status']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

        <!-- Repair Request Form -->

        <button id="showRepairForm">Repair</button> <!-- Button to show repair form -->
        <form id="repairForm" action="repair_product.php" method="post">
            <h2>Repair Product</h2>
            <label for="name">Your Name:</label>
            <input type="text" name="name" required>

            <label for="phone">Your Phone Number:</label>
            <input type="text" name="phoneno" required>

            <label for="product_name">Product Name:</label>
            <select name="productname" required>
                <option value="Gas Stove">Gas Stove</option>
                <option value="Gas Geyser">Gas Geyser</option>
                <option value="Electric Geyser">Electric Geyser</option>
                <option value="Blender">Blender</option>
                <option value="Mixer Grinder">Mixer Grinder</option>
                <option value="Induction">Induction</option>
                <option value="Infra">Infra</option>
                <option value="Dry Iron">Dry Iron</option>
                <option value="Toaster">Toaster</option>
            </select>

            <label for="description">Description of Problem:</label>
            <textarea name="description" required></textarea>

            <!-- Add hidden input for current date -->
            <input type="hidden" name="request_date" value="<?php echo date('Y-m-d'); ?>">

            <button type="submit" name="submit_request">Submit Repair Request</button>
        </form>

    </div>
    <div class="overlay" id="overlay"></div>
    <script>
        // Get references to the repair form and overlay
        const repairForm = document.getElementById('repairForm');
        const overlay = document.getElementById('overlay');
        const showRepairFormButton = document.getElementById('showRepairForm');

        // Function to show the repair form and overlay
        function showRepairForm() {
            repairForm.style.display = 'block';
            overlay.style.display = 'block';
        }

        // Function to hide the repair form and overlay
        function hideRepairForm() {
            repairForm.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Event listener for the "Repair" button click
        showRepairFormButton.addEventListener('click', showRepairForm);

        // Event listener for the overlay click (to close the form)
        overlay.addEventListener('click', hideRepairForm);
    </script>

</body>

</html>