<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your meta tags, CSS links, and other head elements here -->

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
            max-width: 1200px;
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        /* Adjusted image size */
        table img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 50%;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            max-width: 80%;
            max-height: 80%;
            overflow: auto;
        }

        .modal img {
            width: 100%;
            height: auto;
        }

        td.status-column {
            font-weight: bold;
            color: #fff;
            text-align: center;
            padding: 8px;
            border-radius: 4px;
        }

        
        td select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        td button {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
        }

        td button:hover {
            background-color: #0056b3;
        }
        span {
            font-size: 50px;
            color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Repair Requests</h2>
        <?php
        include('../includes/db.php');

        // Function to display success or error messages
        function showMessage($message, $isError = false)
        {
            $class = $isError ? 'error' : 'success';
            echo "<p class='$class'>$message</p>";
        }

        // Process repair request
        if (isset($_POST['process_request'])) {
            $repairId = $_POST['repair_id'];
            $status = $_POST['status'];

            $updateRequestSql = "UPDATE repair SET status = '$status' WHERE id = $repairId";

            if (mysqli_query($conn, $updateRequestSql)) {
                showMessage("Repair request processed successfully!");
            } else {
                showMessage("Error: " . mysqli_error($conn), true);
            }
        }

        // Display repair requests
        $repairSql = "SELECT id, name, phoneno, productname, photo, description, request_date, status FROM repair";
        $repairResult = mysqli_query($conn, $repairSql);

        if (mysqli_num_rows($repairResult) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Request Date</th><th>Name</th><th>Phone Number</th><th>Product Name</th><th>Description</th><th>Status</th><th>UpdateStatus</th></tr>";

            while ($repairRow = mysqli_fetch_assoc($repairResult)) {
                echo "<tr>";
                echo "<td>{$repairRow['id']}</td>";
                echo "<td>{$repairRow['request_date']}</td>";
                echo "<td>{$repairRow['name']}</td>";
                echo "<td>{$repairRow['phoneno']}</td>";
                echo "<td>{$repairRow['productname']}</td>";
                // echo "<td><img src='{$repairRow['photo']}' alt='Product Photo' onclick='openModal(\"{$repairRow['photo']}\")'></td>";
                echo "<td>{$repairRow['description']}</td>";
                echo "<td>{$repairRow['status']}</td>";
                echo "<td>";
                echo "<form action='admin_repair_requests.php' method='post'>";
                echo "<input type='hidden' name='repair_id' value='{$repairRow['id']}'>";
                // echo "<label for='status'>Update Status:</label>";
                echo "<select name='status' required>";
                echo "<option class='pending' value='Pending' " . ($repairRow['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
                echo "<option class='progress' value='In Progress' " . ($repairRow['status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
                echo "<option class='completed' value='Completed' " . ($repairRow['status'] == 'Completed' ? 'selected' : '') . ">Completed</option>";
                echo "</select>";
                echo "<button type='submit' name='process_request'>Update Status</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No repair requests found.";
        }
        ?>
    </div>
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="fullScreenImage" src="" alt="Full Screen Image">
        </div>
    </div>
    <!-- <script>
        // Function to open the modal and display the clicked image
        function openModal(imageSrc) {
            var modal = document.getElementById('imageModal');
            var fullScreenImage = document.getElementById('fullScreenImage');

            fullScreenImage.src = imageSrc;
            modal.style.display = 'flex';
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('imageModal');
            modal.style.display = 'none';
        }
    </script> -->
</body>

</html>