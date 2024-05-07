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
                    <h4 class="form_text"> Select an Airport: </h4>
                    <select name="departure" id="departure">
                            <option value="Eglin AFB, FL, USA">Eglin AFB, FL, USA</option>
                            <option value="Nellis AFB, NV, USA">Nellis AFB, NV, USA</option>
                            <option value="Laughlin AFB, TX, USA">Laughlin AFB, TX, USA</option>
                            <option value="Columbus AFB, MS, USA">Columbus AFB, MS, USA</option>
                            <option value="Holloman AFB, NM, USA">Holloman AFB, NM, USA</option>
                            <option value="Whiteman AFB, MO, USA">Whiteman AFB, MO, USA</option>
                            <option value="Ramstein AB, Rhineland-Palatinate, Germany">Ramstein AB, Rhineland-Palatinate, Germany</option>
                            <option value="Kadena AB, Okinawa, Japan">Kadena AB, Okinawa, Japan</option>
                            <option value="Incirlik AB, Adana, Turkey">Incirlik AB, Adana, Turkey</option>
                            <option value="Osan AB, Pyeongtaek, South Korea">Osan AB, Pyeongtaek, South Korea</option>
                            <option value="RAF Mildenhall, Suffolk, England">RAF Mildenhall, Suffolk, England</option>
                            <option value="Andersen AFB, Yigo, Guam">Andersen AFB, Yigo, Guam</option>
                            <option value="Misawa AB, Aomori, Japan">Misawa AB, Aomori, Japan</option>
                            <option value="Aviano AB, Friuli Venezia Giulia, Italy">Aviano AB, Friuli Venezia Giulia, Italy</option>
                        </select>
                    <input type="submit" value="submit" class="button">
                </form>
            </div>
            <br>
        </div>
    </body>
</html>
