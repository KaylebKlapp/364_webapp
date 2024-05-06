<?php
    $authenticated = false;
    if(isset($_POST['submit']) && $_POST['submit']=="submit")
    {
        $user=$_POST['user'];
        $pwd=$_POST['pwd'];

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
            $query="select * from verify($1, $2)";
            $res = pg_query_params($connection, $query, array($user, $pwd));

            $result = pg_fetch_object($res);
            if($result)
            {
                $authenticated=$result->verify==1;
            }
        }

        if(!$authenticated)
        {
            echo "not valid";
            session_destroy();
        }
        else
        {
            $_SESSION["DoD_ID"] = $user;
            header('location:user_home.html');
        }
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
                    <li><a href = index.html>Home</a></li> 
                    <li><a href = login.php>Login</a></li> 
                    <li><a href = admin.html>Admin</a></li> 
                </ul>
            </nav>
    
            <h2>
                User Login
            </h2>
            
                <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class = "login_form">
                    <label for="user">DoD ID: </label><br>
                    <input type="text" name="user" max="50" placeholder="Enter DoD ID"" required><br>
                    
                    <label for="pwd">Password: </label><br>
                    <input type="password" placeholder="Enter Password" name="pwd" required/><br>
                
                    <input type="submit" value="submit" name="submit"/><br>
                </form>
                <script>
                    function submitForm(form){
                        if (form.checkValidity()){
                            window.location = 'user_home.html';
                            return false;
                        }
                        return true;
                    }
                </script>
        </div>
    </body>

</html>
