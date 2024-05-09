<?php
session_start();
$authenticated = false;
if (isset($_POST['submit']) && $_POST['submit'] == "submit") {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

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
    if (!$_SESSION["DoD_ID"]) {
        header('location:login.php');
    }
    if ($connection) {
        $query = "select verify.verify from verify($1, $2)";

        $res = pg_query_params($connection, $query, array($user, $pwd));

        $result = pg_fetch_object($res);
        if ($result) {
            $authenticated = $result->verify;
            echo $authenticated;

            if ($authenticated == 2) {
                header('location:admin.php');
                $_SESSION["admin"] = 1;
                echo 'admin';
            } elseif ($authenticated == 1) {
                header('location:user_home.php');
                $_SESSION["admin"] = 0;
                echo 'not admin';
            } else {
                $_SESSION["authenticated"] = 0;
            }
        }
    }

    if ($authenticated) {
        $_SESSION["DoD_ID"] = $user;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Space A Reservation Application</title>
    <link rel="stylesheet" , href="csl.css">
</head>

<body>
    <h1>Space Available Reservation Application</h1>

    <div class="site_body">
        <nav>
            <ul class="navtxt">
                <li><a href=logout.php>Home</a></li>
                <li><a href=login.php>Login</a></li>
            </ul>
        </nav>

        <h2>
            User Login
        </h2>

        <h3>No account? <a href="register.php" class="nobox"> Register </a></h3>
        <form form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login_form">
            <label for="user">DoD ID: </label><br>
            <input type="text" name="user" max="50" placeholder="Enter DoD ID" pattern="[0-9]{10}" required><br>

            <label for="pwd">Password: </label><br>
            <input type="password" placeholder="Enter Password" name="pwd" required /><br>

            <input type="submit" value="submit" name="submit" /><br>
            <?php if (isset($_SESSION["authenticated"])) {
                if ($_SESSION["authenticated"] == 0) {
                    echo "<h5>Invalid Login</h5>";
                }
            } else {
                echo "";
            } ?>
        </form>
        <script>
            function submitForm(form) {
                if (form.checkValidity()) {
                    window.location = 'user_home.php';
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>