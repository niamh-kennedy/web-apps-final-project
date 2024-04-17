/* reused code from sessions_lab */
<?php
require "src/DBconfig.php";

/* Open a connection via PDO to create a new database and table with structure */
try{
    $connection = new PDO("mysql:host=$host", $username, $password, $options);

    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);
    echo "Database and table users created successfully.";
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}