<?php
    session_start();
    
    if(!$_SESSION["DoD_ID"]){
        header('location:login.php');
    }
    if ($_SESSION["admin"] == 0){
        header('location:user_home.php');
    }
    
    if(isset($_POST['update']) && $_POST['update']=="Update")
    {
        $dodid=$_POST['dodid'];

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
            $query2="DELETE FROM reservation WHERE reservation.\"DoD_ID\" =($1);";
            $query="DELETE FROM people WHERE people.\"dod_id\" =($1);";
            $res = pg_query_params($connection, $query, array($dodid));
            $res = pg_query_params($connection, $query2, array($dodid));
            
            if($res)
            {
                echo "User removed.";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Remove a user:</title>
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Insert the DoD ID of the user to be removed:</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = user_home.php>User Menu</a></li> 
                    <li><a href = admin.php>Admin Menu</a></li> 
                </ul>
            </nav>
    
            <h2>
                Remove a user:
            </h2>
            
                <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class = "login_form">
                    <label for="user">DoD ID: </label><br>
                    <input type="text" name="dodid" max="50" placeholder="Enter Unique DoD ID" required><br>
                
                    <input type="submit" value="Update" name="update"/><br>
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
