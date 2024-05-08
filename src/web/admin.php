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
                    <li><a href = logout.php>Logout</a></li> 
                </ul>
            </nav>
            <h3>Enter Flight Information:</h3>
            <form method="post">
                <label for = "flightNum">Flight Number: </label>
                <input type = "text" id ="flightNum" name = "flightNum" required/><br>
                
                <label for = "departLocation">Departure Location: </label>
                <input type = "text" id ="departLocation" name = "departLocation" required/><br>
                
                <label for = "unitName">Unit Name: </label>
                <input type = "text" id = "unitName" name = "unitName" required/><br>

                <label for = "arriveLocation">Arrival Location: </label>
                <input type = "text" id ="arriveLocation" name = "arriveLocation" required/><br>

                <label for = "aircraftType">Aircraft Type: </label>
                <input type = "text" id ="aircraftType" name = "aircraftType" required/><br>

                <label for = "totalSeats">Total Seats: </label>
                <input type = "text" id ="totalSeats" name = "totalSeats" required/><br>

                <label for = "departTime">Departure Time: </label>
                <input type = "text" id ="departTime" name = "departTime" required/><br>

                <label for = "arriveTime">Arrival Time: </label>
                <input type = "text" id ="arriveTime" name = "arriveTime" required/><br>
                
                <input type = "submit" value = "Update"/>
                <input type = "submit" value = "Add"/>
                <input type = "submit" value = "Delete"/>
            </form>
        </div>
    </body>

</html>
