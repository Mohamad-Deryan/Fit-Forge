<!DOCTYPE html>
<html>
<head>
    <title>Goals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
            margin: 0 auto;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    // Start session to store email
    session_start();

    // Check if email is provided in the POST data
    if (isset($_POST['email'])) {
        // Store email in session
        $_SESSION['email'] = $_POST['email'];
    }

    // Check if email is stored in session
    if (isset($_SESSION['email'])) {
        // Include the database connection file
        include 'database.php';

        // Sanitize the email input
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);

        // Query to select goals for the given email
        $query = "SELECT * FROM goals WHERE Email='$email'";
        $result = mysqli_query($conn, $query);

        // Check if any goals are found
        if ($result && mysqli_num_rows($result) > 0) {
            // Display goals in a table
            echo "<h2>Goals for $email</h2>";
            echo "<form action='update-goal.php' method='post'>";
            echo "<table>";
            echo "<tr><th>Title</th><th>Description</th><th>Target Date</th><th>Completed</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['target_date']}</td>";
                echo "<td><input type='checkbox' name='completed[]' value='{$row['goal_id']}' ";
                echo $row['completed'] ? 'checked' : '';
                echo "></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='hidden' name='email' value='$email'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";

            // Add buttons to go to add-goal.html and Workout_Center.html
            echo "<br>";
            echo "<button onclick=\"window.location.href='add-goal.html'\">Add New Goal</button>";
            echo "<button onclick=\"window.location.href='Workout_Center.html'\">Go to Workout Center</button>";
        } else {
            echo "No goals found for $email";
			echo "<button onclick=\"window.location.href='add-goal.html'\">Add New Goal</button>";
            echo "<button onclick=\"window.location.href='Workout_Center.html'\">Go to Workout Center</button>";
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If email is not set, redirect to add-goal.html
        header("Location: add-goal.html");
        exit();
    }
    ?>
</body>
</html>