<?php
// Start or resume a session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: Login.html");
    exit();
}

// Include the database connection file
include 'database.php';

// Initialize variables
$newPassword = $confirmPassword = "";
$newPasswordErr = $confirmPasswordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate new password
    if (empty($_POST["new_password"])) {
        $newPasswordErr = "New password is required";
    } else {
        $newPassword = sanitizeData($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Please confirm password";
    } else {
        $confirmPassword = sanitizeData($_POST["confirm_password"]);
        if ($newPassword != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If there are no errors, update the password
    if (empty($newPasswordErr) && empty($confirmPasswordErr)) {
        $email = $_SESSION['email'];
        // No need to hash the password for this implementation
        $password = $newPassword;

        // Update the password in the database
        $updateQuery = "UPDATE Users SET Password='$password' WHERE Email='$email'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Password updated successfully
            echo "<script>alert('Password updated successfully.');</script>";
            // Redirect to profile page
            echo "<script>window.location.href = 'Profile.php';</script>";
            exit();
        } else {
            // Error updating password
            echo "<script>alert('Error updating password. Please try again.');</script>";
        }
    }
}

// Function to sanitize input data
function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .error {
            color: #ff0000;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Password</h2>
    <form action="" method="post">
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <span class="error"><?php echo $newPasswordErr; ?></span>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>