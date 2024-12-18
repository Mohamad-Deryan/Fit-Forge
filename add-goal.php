<?php

include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = sanitizeData($_POST["email"]);
    $title = sanitizeData($_POST["title"]);
    $description = sanitizeData($_POST["description"]);
    $target_date = sanitizeData($_POST["target_date"]);


    $checkEmailQuery = "SELECT * FROM Users WHERE Email='$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) == 1) {

        $insertGoalQuery = "INSERT INTO goals (title, description, target_date, Email) VALUES ('$title', '$description', '$target_date', '$email')";
        mysqli_query($conn, $insertGoalQuery);


        header("Location: ind.php");
        exit();
    } else {
        echo "<script>alert('Error: Email does not exist in the database.'); window.location='add-goal.html';</script>";
    }


    mysqli_close($conn);
}


function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
