<?php
    session_start();
    
    if(!$_SESSION["DoD_ID"]){
        header('location:login.php');
    }
    if ($_SESSION["admin"] == 0){
        header('location:user_home.php');
    }
    
    
    if(isset($_POST['remove']) && $_POST['remove']=="Remove")
    {
        $flight_id=$_POST['flight_id'];

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
            $query1="DELETE FROM reservation WHERE reservation.\"flight_ID\" = ($1);";
            $query2="DELETE FROM flight WHERE flight.\"flight_ID\" = ($1);";

            $res = pg_query_params($connection, $query1, array($flight_id));
            $res = pg_query_params($connection, $query2, array($flight_id));
            
            if($res)
            {
                echo "Flight removed.";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Remove a Flight</title>
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Remove a Flight</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = user_home.php>User Menu</a></li> 
                    <li><a href = admin.php>Admin Menu</a></li> 
                </ul>
            </nav>
    
            <h2>
                Enter the Flight Information Below for Deletion:
            </h2>
            
                <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class = "login_form">
                    <label for="user">Flight ID: </label><br>
                    <input type="text" name="flight_id" max="50" placeholder="Enter Unique Numeric Flight Code" required><br>
                
                    <input type="submit" value="Remove" name="remove"/><br>
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
