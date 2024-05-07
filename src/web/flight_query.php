<?php
    // Establish credentials for database
    session_start();
    if(!$_SESSION["DoD_ID"]){
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Space A Reservation Application</title>
        <meta name="description" content="Space A reservation webapp.">
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Space Available Reservation Application</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = user_home.php>User Home</a></li> 
                    <li><a href = logout.php>Log Out</a></li> 
                </ul>
            </nav>

            <h2>Find Flights</h2>
            <h3>Enter Desired Departure Location</h3>
            <div class="formbody">
                <form method="post" class = "reserve_form" action="flights.php">
                    Departure Airport:<input type="text" id="departure" name="departure" required>
                    <br>
                    <input type="submit" value="submit" class="button">
                </form>
            </div>
            <br>
        </div>
    </body>
</html>
