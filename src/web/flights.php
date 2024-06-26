<?php
session_start();
if (!$_SESSION["DoD_ID"]) {
    header('location:login.php');
}
$dbHost = 'localhost';
$dbPort = '5432';
$dbName = 'space-a';
$dbUsername = 'student';
$dbPassword = 'CompSci364';

// Connection string
$connectionString = "host=$dbHost port=$dbPort dbname=$dbName user=$dbUsername password=$dbPassword";

// Connect to Database
$connection = pg_connect($connectionString);
if (!$connection) {
    die("Error: Unable to connect to the database. Please try again later.");
}

// Grab form data
$departure_location = $_POST['departure'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Space A Reservation Application</title>
    <link rel="stylesheet" href="csl.css">
</head>

<body>
    <h1>Space Available Reservation Application</h1>
    <div class="site_body">
        <nav>
            <ul class="navtxt">
                <li><a href="user_home.php">User Home</a></li>
                <li><a href=logout.php>Log Out</a></li>
                <?php if ($_SESSION["admin"] == 1) {
                    echo "<li><a href = admin.php>Admin Menu</a></li>";
                } ?>
            </ul>
        </nav>

        <h2>Flights Available</h2>
        <table>
            <tr>
                <th>Departure Location</th>
                <th>Arrival Location</th>
                <th>Seats Left</th>
                <th>Aircraft Type</th>
                <th>Departure Date</th>
                <th>Departure Time</th>
                <th>Arrival Date</th>
                <th>Arrival Time</th>
                <th></th>
            </tr>
            <?php
            $query = "SELECT 
                a1.airport_location AS \"Departure Location\",
                a2.airport_location as \"Arrival Location\",
                p.model AS \"Aircraft Type\",
                f.departure_date AS \"Departure Date\",
                f.departure_time as \"Departure Time\",
                f.arrival_date AS \"Arrival Date\",
                f.arrival_time AS \"Arrival Time\",
                f.\"flight_ID\" as \"flight_id\",
                (f.maximum_seats - COUNT(r.\"DoD_ID\")) AS \"Remaining Seats\"

                FROM 
                    flight f
                JOIN 
                    airport a1 ON f.\"from_airport_ID\" = a1.\"airport_ID\"
                JOIN 
                    airport a2 ON f.\"to_airport_ID\" = a2.\"airport_ID\"
                LEFT JOIN 
                    reservation r ON f.\"flight_ID\" = r.\"flight_ID\"
                JOIN 
                    plane p ON f.\"plane_ID\" = p.\"plane_ID\"
                WHERE 
                    a1.airport_location = $1
                GROUP BY 
                    f.\"flight_ID\", a1.\"airport_location\", a2.\"airport_location\", p.\"model\", f.departure_date, f.departure_time, f.arrival_date, f.arrival_time";

            $result = pg_prepare($connection, "flight_query", $query);
            $result = pg_execute($connection, "flight_query", array($departure_location));

            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Departure Location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Arrival Location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Remaining Seats']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Aircraft Type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Departure Date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Departure Time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Arrival Date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Arrival Time']) . "</td>";
                    echo "<td>" . "<form class=\"miniform\" action=\"confirmation.php\" method=\"post\"><input type=\"hidden\" name=\"flight_id\" id=\"flight_id\" value=" . $row['flight_id'] . "><input class=\"miniform\" type=\"submit\" value=\"Reserve\"></form>" . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No flights found or error in query execution.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>