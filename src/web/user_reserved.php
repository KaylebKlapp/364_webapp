<?php
    // Establish credentials for database
    session_start();
    if(!$_SESSION["DoD_ID"]){
        header('location:login.php');
    }
    $dbHost = 'localhost';
    $dbPort = '5432';
    $dbName = 'space-a';
    $dbUsername = 'student';
    $dbPassword = 'CompSci364';

    // Connect to Database
    $connection = pg_connect("host=$dbHost port = $dbPort dbname=$dbName user=$dbUsername password=$dbPassword");
    if (!$connection){
        die("Error: Unable to connect to $dbName database. Please try again.");
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
                <li><a href = user_home.php>User Home</a></li> 
                <li><a href = logout.php>Log Out</a></li>
                <?php if($_SESSION["admin"]==1){echo "<li><a href = admin.php>Admin Menu</a></li>";}?>
            </ul>
        </nav>
        
        <h2>Flights Reserved</h2>
        <table>
            <tr>
                <th>Departue Location</th>
                <th>Arrival Location</th>
                <th>Aircraft Type</th>
                <th>Remaining Seats</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
            </tr>
            <?php
                if($connection)
                {
                    $query = "SELECT 
                    a1.airport_location AS \"Departure Location\",
                    a2.airport_location AS \"Arrival Location\",
                    p.model AS \"Aircraft Type\",
                    (f.maximum_seats - COUNT(r.\"DoD_ID\")) AS \"Remaining Seats\",
                    f.departure_date AS \"Departure Time\",
                    f.arrival_date AS \"Arrival Time\"
                    FROM 
                        reservation r
                    JOIN 
                        flight f ON r.\"flight_ID\" = f.\"flight_ID\"
                    JOIN 
                        airport a1 ON f.\"from_airport_ID\" = a1.\"airport_ID\"
                    JOIN 
                        airport a2 ON f.\"to_airport_ID\" = a2.\"airport_ID\"
                    JOIN 
                        plane p ON f.\"plane_ID\" = p.\"plane_ID\"
                    LEFT JOIN 
                        reservation r2 ON f.\"flight_ID\" = r2.\"flight_ID\"
                    WHERE 
                        r.\"DoD_ID\" = " . $_SESSION['DoD_ID'] . "
                    GROUP BY 
                        f.\"flight_ID\", a1.\"airport_location\", a2.\"airport_location\", p.\"model\", f.\"maximum_seats\", f.\"departure_date\"";
            
                    $res = pg_query($connection, $query);
                    if ($res) {
                        // Fetch each row and print it
                        while ($row = pg_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>" . $row['Departure Location'] . "<br>";
                            echo "<td>" . $row['Arrival Location'] . "<br>";
                            echo "<td>" . $row['Aircraft Type'] . "<br>";
                            echo "<td>" . $row['Remaining Seats'] . "<br>";
                            echo "<td>" . $row['Departure Time'] . "<br>";
                            echo "<td>" . $row['Arrival Time'] . "<br><br>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Query failed: " . pg_last_error($connection);
                    }
                }
            ?>
        </table>
            </div>
    </body>

</html>