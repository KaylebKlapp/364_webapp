<?php
    if(isset($_POST['register']) && $_POST['register']=="Register")
    {
        $lname=$_POST['lastname'];
        $dodid=$_POST['dodid'];
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
            $query="INSERT INTO people VALUES ($1, $2, crypt($3, gen_salt('md5')));";
            $res = pg_query_params($connection, $query, array($dodid, $lname, $pwd));
            
            if($res)
            {
                header('location:login.php');
            }
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
                    <input type="text" name="dodid" max="50" placeholder="Enter DoD ID" pattern="[0-9]{10}" required><br>

                    <label for="user">Last Name: </label><br>
                    <input type="text" name="lastname" max="50" placeholder="Enter Last Name" pattern="[a-zA-Z-]{10}" required><br>
                    
                    <label for="pwd">Password: </label><br>
                    <input type="password" placeholder="Enter Password" name="pwd" pattern="{3}" required/><br>
                
                    <input type="submit" value="Register" name="register"/><br>
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
