<?php
// Start session to get email
session_start();

// Check if email is stored in session
if (isset($_SESSION['email'])) {
    // Include the database connection file
    include 'database.php';

    // Check if completed goals are submitted
    if (isset($_POST['completed']) && is_array($_POST['completed'])) {
        // Sanitize the email input
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);

        // Iterate through the completed goals
        foreach ($_POST['completed'] as $goal_id) {
            // Delete the selected goals from the database
            $deleteQuery = "DELETE FROM goals WHERE goal_id='$goal_id' AND Email='$email'";
            mysqli_query($conn, $deleteQuery);
        }

        // Redirect back to the ind.php page
        header("Location: ind.php");
        exit();
    } else {
        echo "No goals were selected.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If email is not set, redirect to add-goal.html
    header("Location: add-goal.html");
    exit();
}
?>
