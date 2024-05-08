<?php
    if(isset($_POST['add']) && $_POST['add']=="Add")
    {
        $flight_id=$_POST['flight_id'];
        $plane_id=$_POST['plane_id'];
        $departure_id=$_POST['departing_airport_id'];
        $arrival_id=$_POST['arriving_airport_id'];
        $max_seats=$_POST['max_seats'];
        $departure_time=$_POST['departure_time'];
        $arrival_time=$_POST['arrival'];

        // Establish credentials for database
        session_start();
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
            $query="INSERT INTO flight VALUES ($1, $2, $3, $4, $5, $6, $7);";
            $res = pg_query_params($connection, $query, array($flight_id, $plane_id, $departure_id, $arrival_id, $max_seats, date('Y-m-d h:i:s', strtotime($departure_time)), date('Y-m-d h:i:s', strtotime($arrival_time))));
            
            if($res)
            {
                echo "Flight added.";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Add a New Flight</title>
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Add a New Flight</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = admin.php>Admin Home</a></li> 
                </ul>
            </nav>
    
            <h2>
                Enter the new Flight Information Below:
            </h2>
            
                <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class = "login_form">
                    <label for="user">Flight ID: </label><br>
                    <input type="text" name="flight_id" max="50" placeholder="Enter Unique Numeric Flight Code" required><br>

                    <label for="user">Plane ID: </label><br>
                    <input type="text" name="plane_id" max="50" placeholder="Enter Unique Assigned Plane ID" required><br>

                    <label for="user">Departing Airport ID: </label><br>
                    <input type="text" name="departing_airport_id" max="50" placeholder="Enter Departing Airport ID" required><br>

                    <label for="user">Ariving Airport ID: </label><br>
                    <input type="text" name="arriving_airport_id" max="50" placeholder="Enter Arriving Airport ID" required><br>

                    <label for="user">Available Seats: </label><br>
                    <input type="text" name="max_seats" max="50" placeholder="Enter Availabel Seats" required><br>

                    <label for="user">Departing Date and Time: </label><br>
                    <input type="datetime-local" name="departure_time" max="50" placeholder="Enter Departure Time" required><br>

                    <label for="user">Arrival Date and Time: </label><br>
                    <input type="datetime-local" name="arrival" max="50" placeholder="Enter Arrival Time" required><br>
                
                    <input type="submit" value="Add" name="add"/><br>
                </form>
                <script>
                    function submitForm(form){
                        if (form.checkValidity()){
                            window.location = 'login.php';
                            return false;
                        }
                        return true;
                    }
                </script>
        </div>
    </body>

</html>
