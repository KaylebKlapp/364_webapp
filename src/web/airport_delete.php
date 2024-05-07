<?php
    if(isset($_POST['delete']) && $_POST['delete']=="Delete")
    {
        $airport_id=$_POST['airport_id'];

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
            $query="DELETE FROM airport WHERE airport_ID = ($1);";
            $res = pg_query_params($connection, $query, array($airport_id));
            
            if($res)
            {
                echo "Airport removed.";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Remove an Airport</title>
        <meta name="description" content="Space A reservation webapp.">
        <link rel="stylesheet", href="csl.css">
    </head>
    <body>
        <h1>Remove an airport</h1>

        <div class="site_body">
            <nav>
                <ul class = "navtxt">
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = admin.html>Admin Home</a></li> 
                </ul>
            </nav>
    
            <h2>
                Enter the Airport Information Below To Remove:
            </h2>
            
                <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class = "login_form">
                    <label for="user">Airport ID: </label><br>
                    <input type="text" name="airport_id" max="50" placeholder="Enter Unique Numeric Code" required><br>
                
                    <input type="submit" value="Delete" name="delete"/><br>
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