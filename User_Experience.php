<?php
    include("database.php");

    $tex = $_POST['experience'];
    if(empty($tex)){
    }
    else{
        $sql = "INSERT INTO Reviews (review) VALUES ('$tex')";
        mysqli_query($conn, $sql);
    }

    mysqli_close($conn);

    header("Location: Main_Page.html");
?>