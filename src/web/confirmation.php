<?php
    // Establish credentials for database
    session_start();
    if(!$_SESSION["DoD_ID"]){
        header('location:login.php');
    }

    $flight_id = $_POST['flight_id'];
    $dodid = $_SESSION["DoD_ID"];

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

    if($connection)
    {
        $query2 = "SELECT maximum_seats - (SELECT COUNT(*) FROM reservation WHERE flight.\"flight_ID\" = reservation.\"flight_ID\") as count
        FROM flight
        WHERE flight.\"flight_ID\" = ($1);";
        
        $result = pg_query_params($connection, $query2, array($flight_id));

        $row = pg_fetch_assoc($result);
        if ($row['count'] < 1) {
            $str = "Reservation Failed. This flight is at capacity.";
        }
        else {
            $query="INSERT INTO reservation VALUES ($1, $2, $3)";
            if (@pg_query_params($connection, $query, array($dodid, $flight_id, 0))) {
                $str = "Congratulations! You have reserved your flight!";
            } else {
                $str = "Reservation Failed. You have already reserved this flight.";
            }
        }
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
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = user_home.php>User Menu</a></li> 
                    <li><a href = admin.php>Admin Menu</a></li> 
                </ul>
            </nav>
            <p>
                <?php echo $str; ?>
            </p>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Air_Mobility_Command.svg/220px-Air_Mobility_Command.svg.png" alt="Cadet Service Learning Logo"><br>
        </div>
    </body>

</html>