<?php
    session_start();

    include("database.php");
    $Email = $_SESSION['Email'];

    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $subscription_type = $_POST["subscription"];
    $Card_Name = $_POST["cardname"];
    $Credit_num = $_POST["CreditNum"];
    $Month = $_POST["Expiration_month"];
    $Year = $_POST["Expiration_year"];
    $CVV = $_POST["CreditCVV"];

    $Expiry = $Month . ' ' . $Year;

    if(empty($gender) || empty($age) || empty($subscription_type) || empty($Card_Name) || empty($Credit_num) || empty($Month) || empty($Year) || empty($CVV)){
    }

    else{
        $insert_credit_card_sql = "INSERT INTO Credit_Card (Credit_Card_Number, Card_Holder_Name, Expiry_Date, CVV)
                                   VALUES ('$Credit_num', '$Card_Name', '$Expiry', '$CVV')";
        mysqli_query($conn, $insert_credit_card_sql);


        $update_users_sql = "UPDATE Users 
                             SET Gender='$gender', Age='$age', Subscription='$subscription_type', Credit_Card_Number='$Credit_num' 
                             WHERE Email='$Email'";
        mysqli_query($conn, $update_users_sql);

        session_destroy();

        header("Location: Login.html");

        mysqli_close($conn);

    }
?>