<?php
session_start();

if (!$_SESSION["DoD_ID"]) {
    header('location:login.php');
}
if ($_SESSION["admin"] == 0) {
    header('location:user_home.php');
}

if (isset($_POST['add']) && $_POST['add'] == "Add") {
    $airport_id = $_POST['airport_id'];
    $location = $_POST['location'];

    // Establish credentials for database
    if (!$_SESSION["DoD_ID"]) {
        header('location:login.php');
    }
    if ($_SESSION["admin"] == 0) {
        header('location:user_home.php');
    }

    $dbHost = 'localhost';
    $dbPort = '5432';
    $dbName = 'space-a';
    $dbUsername = 'student';
    $dbPassword = 'CompSci364';

    // Connect to Database
    $connection = pg_connect("host=$dbHost port = $dbPort dbname=$dbName user=$dbUsername password=$dbPassword");
    if (!$connection) {
        die("Error: Unable to connect to $dbName database. Please try again.");
    }

    if ($connection) {
        $query = "INSERT INTO airport VALUES ($1, $2);";
        $res = pg_query_params($connection, $query, array($airport_id, $location));

        if ($res) {
            echo "Airport added.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin: Add an Airport</title>
    <link rel="stylesheet" , href="csl.css">
</head>

<body>
    <h1>Add an airport</h1>

    <div class="site_body">
        <nav>
            <ul class="navtxt">
                <li><a href=logout.php>Log Out</a></li>
                <li><a href=user_home.php>User Menu</a></li>
                <li><a href=admin.php>Admin Menu</a></li>
            </ul>
        </nav>

        <h2>
            Enter the Airport Information Below:
        </h2>

        <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login_form">
            <label for="user">Airport ID: </label><br>
            <input type="text" name="airport_id" max="50" placeholder="Enter Unique Numeric Code" required><br>

            <label for="user">Location: </label><br>
            <input type="text" name="location" max="80" placeholder="Enter Location (City, State)"
                pattern="[a-zA-Z -]{10}" required><br>

            <input type="submit" value="Add" name="add" /><br>
        </form>
        <script>
            function submitForm(form) {
                if (form.checkValidity()) {
                    window.location = 'login.php';
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>