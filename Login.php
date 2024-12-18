<?php

include 'database.php';


session_start();


function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = sanitizeData($_POST["email"]);
    $password = sanitizeData($_POST["password"]);


    $query = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
    $result = mysqli_query($conn, $query);


    if ($result) {

        if (mysqli_num_rows($result) == 1) {

            $_SESSION['email'] = $email; 
            header("Location: Profile.php"); 
            exit();
        } else {

            echo "<script>alert('Invalid email or password. Please try again.')</script>";
            echo "<script>window.location.href = 'Login.html';</script>";
            exit();
        }
    } else {

        echo "<script>alert('Error: ". mysqli_error($conn) ."')</script>";
        echo "<script>window.location.href = 'Login.html';</script>";
        exit();
    }


    mysqli_close($conn);
}
?>
