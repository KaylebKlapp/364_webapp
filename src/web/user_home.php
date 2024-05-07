<?php 
    session_start();
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
                    <li><a href = index.html>Log Out</a></li> 
                </ul>
            </nav>
    
            <h2>
                Space Available Introduction
            </h2>
            
    
            <p1>Welcome to Space-A!
                <br><br>
                <button class = "user_button" onclick="window.location.href='user_reserved.html'">My Reserved Flights</button>
                <br>
                <button class = "user_button" onclick="window.location.href='flight_query.html'">New Flight</button><br>
            </p1>
            </body>
        </div>
    </body>

</html>