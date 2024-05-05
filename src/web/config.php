<?php

// Establish credentials for database
$dbHost = 'localhost';
$dbPort = '5432';
$dbName = 'space-a';
$dbUsername = 'student';
$dbPassword = 'CompSci364';

// Connect to Database
$db = pg_connect("host=$dbHost port = $dbPort dbname=$dbName user=$dbUsername password=$dbPassword");
if (!$db){
    die("Error: Unable to connect to $dbName database. Please try again.");
}
?>