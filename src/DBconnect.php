/* reused code from sessions_lab*/
<?php
require_once '../src/DBconfig.php'; //access the login values

try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>