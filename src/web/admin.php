<?php
session_start();
if(!$_SESSION["DoD_ID"]){
    header('location:login.php');
}
if ($_SESSION["admin"] == 0){
    header('location:user_home.php');
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Space A Reservation Application</title>
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Space Available Reservation Application</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = logout.php>Log Out</a></li> 
                    <li><a href = user_home.php>User Menu</a></li> 
                    <li><a href = admin.php>Admin Menu</a></li> 
                </ul>
            </nav>
            <h3>Admin Home</h3>
            <div class = "admin_homepage">
                <a class="admin_button" href="flight_add.php"><button class="admin_form_button">Add a flight</button></a>
                <a class="admin_button" href="flight_delete.php"><button class="admin_form_button">Remove a flight</button></a><br>
                <a class="admin_button" href="airport_add.php"><button class="admin_form_button">Add a destination</button></a>
                <a class="admin_button" href="airport_delete.php"><button class="admin_form_button">Remove a destination</button></a><br>
                <a class="admin_button" href="manage_admins.php"><button class="admin_form_button">Add an administrator</button></a>
                <a class="admin_button" href="remove_users.php"><button class="admin_form_button">Remove a user</button></a><br>
            </div>
        </div>
    </body>

</html>
