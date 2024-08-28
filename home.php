<?php
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="home.php">Logo</a></p>
    </div>

    <div class="right-links">

        <?php

        $id = $_SESSION["Id"];

        // Ensure proper escaping of the ID to prevent SQL injection
        $escaped_id = mysqli_real_escape_string($con, $id);
        $query = mysqli_query($con, "SELECT * FROM users WHERE Id = '$escaped_id'");

        // Check if the query was successful
        if ($query) {
            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result["Username"];
                $res_Email = $result["Email"];
                $res_Age = $result["Age"];
                $res_Id = $result["Id"];
            }
                // Print the link here
                echo "<a href='edit.php?Id=$res_id'>Change Profile</a>" ;
        } else {
            // Handle the error appropriately, e.g., display an error message or redirect to an error page
            echo "Error fetching user data: " . mysqli_error($con);
            // Consider redirecting to an error page:
            // header("Location: error.php");
            // exit();
        }
        mysqli_close($con); // Close the database connection
        ?>
        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
    </div>
</div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b>20 years old</b>.</p>
                </div>
            </div>
        </div>

    </main>
</body>
</html>