/* reused code from sessions_lab */
<?php
/* Configuration for database connection */
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "final_project";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);