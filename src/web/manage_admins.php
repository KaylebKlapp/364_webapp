<?php
session_start();

if (!$_SESSION["DoD_ID"]) {
    header('location:login.php');
}
if ($_SESSION["admin"] == 0) {
    header('location:user_home.php');
}


if (isset($_POST['update']) && $_POST['update'] == "Update") {
    $dodid = $_POST['dodid'];

    // Establish credentials for database
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
        $query = "UPDATE people SET admin = true where dod_id =($1);";
        $res = pg_query_params($connection, $query, array($dodid));

        if ($res) {
            echo "User upgraded.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin: Make an Administrator</title>
    <link rel="stylesheet" , href="csl.css">
</head>

<body>
    <h1>Insert the DoD ID of the user:</h1>

    <div class="site_body">
        <nav>
            <ul class="navtxt">
                <li><a href=logout.php>Log Out</a></li>
                <li><a href=user_home.php>User Menu</a></li>
                <li><a href=admin.php>Admin Menu</a></li>
            </ul>
        </nav>

        <h2>
            Enter the information of new Admin:
        </h2>

        <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login_form">
            <label for="user">DoD ID: </label><br>
            <input type="text" name="dodid" max="50" placeholder="Enter Unique DoD ID" required><br>

            <input type="submit" value="Update" name="update" /><br>
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