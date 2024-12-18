<?php
    session_start();

    include("database.php");

    $FN = $_POST['FN'];
    $LN = $_POST['LN'];
    $Email = $_POST['email'];
    $password = $_POST['password'];
    $Username = $FN . ' ' . $LN;

    if(empty($FN) || empty($password) || empty($LN) || empty($Email)) {
    }

    else{
        $sql = "INSERT INTO Users (FN, LN, Username, Email, Password)
                VALUES ('$FN', '$LN', '$Username','$Email', '$password')";

        mysqli_query($conn, $sql);

        $_SESSION['Email'] = $Email;

        mysqli_close($conn);

        header("Location: Info.html");
    }
?>