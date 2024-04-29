<?php

    function getUserByEmail($connection, $email)
    {
        // require_once '../queries/getUser.php';
        // $user = getUserByEmail($connection, $email);

        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    function getUserByID($connection, $id)
    {
        // require_once '../queries/getUser.php';
        // $user = getUserByEmail($connection, $id);

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }