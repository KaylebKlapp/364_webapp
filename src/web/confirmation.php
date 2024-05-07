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
            <p>
                Congratulations! You have reserved your flight!
            </p>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Air_Mobility_Command.svg/220px-Air_Mobility_Command.svg.png" alt="Cadet Service Learning Logo"><br>
        </div>
    </body>

</html>