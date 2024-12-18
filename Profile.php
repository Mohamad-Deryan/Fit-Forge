<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: Login.html");
    exit();
}

include 'database.php';

$email = $_SESSION['email'];
$query = "SELECT * FROM Users WHERE Email='$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {

    header("Location: Login.html");
    exit();
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css sheet -->
    <link rel="stylesheet" href="Allwebsite.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/8a9bc23044.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body class="Profile_page_col">
    <header class="Pages_header">
        <div class="navBar_plans"> 
            <nav class="navigation_plans">
                <h2 class="Fit_Forge_wc">FIT FORGE</h2>
                <a href="logout.php" class="Profile" id="Log_Out_Account">Log Out<i class="fa-solid fa-right-from-bracket"></i></a>
            </nav>
        </div>
    </header>

    <section>
        <div id="Container_box">
            <!-- A box containing two options, either getting back to training plans or to Library of exercises -->
            <div id="getting_back">
                <div><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i><a href="Workout_Center.html">Workout Center</a></div>
            </div>

            <!-- Box containing inside another box holding the profile info -->
            <div id="Bigg_box_profile">
                <!-- Box holding profile info, was placed inside a parent box to make it easier to style both -->
                <div id="Profile_box">
                    <!-- A box containing the user's image with a cover photo and his name -->
                    <div id="image_holder">
                        <div id="cover_photo"><img src="Main_screen_photos/One_more.jpeg?<?php echo time(); ?>" alt="">
                            <!-- The below box was made to be able to display it above the parent box and not below it. -->
                            <div id="profile_pic"><img src="Main_screen_photos/jay cutler.jpeg" alt=""></div>
                            <div id="Person_own_username"><?php echo $user['Username']; ?></div>
                        </div>
                    </div>

                    <!-- The content of the profile -->
                    <div id="Prof_Content">
                        <div class="All_content"><div>Email</div><div><?php echo $user['Email']; ?></div></div>
                        <div class="All_content"><div>Subscription</div><div><?php echo $user['Subscription']; ?></div></div>
                        <div class="All_content">
                            <div>Password</div>
                            <div>*********</div>
                            <div><a href="edit_password.php">Edit</a></div>
                        </div>
                        <div class="All_content">
                            <div>Credit Card</div>
                            <div><?php echo $user['Credit_Card_Number']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
