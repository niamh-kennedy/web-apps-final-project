<?php

    function getUserByEmail($connection, $email) {

        try {

            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }
    function getUserByID($id) {

        try {

            $sql = "SELECT * FROM users WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function deleteUser($connection, $id) {

        try {

            $sql = "DELETE FROM users WHERE id = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function createUser($connection, $email, $password, $firstName, $lastName, $street, $town, $contactNum) {
        try {

            $new_user = array (
                "email"         => $email,
                "password"      => $password,
                "firstName"     => $firstName,
                "lastName"      => $lastName,
                "street"        => $street,
                "town"          => $town,
                "contactNum"    => $contactNum
            );

            $sql = sprintf("INSERT INTO %s (%s) values (%s)", "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)));

            $statement = $connection->prepare($sql);
            $statement->execute($new_user);

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    }

    function updateUser($connection, $id, $email, $password, $firstName, $lastName, $street, $town, $contactNum) {
        try {

            $user = array (
                "id"            => $id,
                "email"         => $email,
                "password"      => $password,
                "firstName"     => $firstName,
                "lastName"      => $lastName,
                "street"        => $street,
                "town"          => $town,
                "contactNum"    => $contactNum
            );

            $sql = "UPDATE users
                        SET id          = :id,
                            email       = :email,
                            password    = :password,
                            firstName   = :firstName,
                            lastName    = :lastName,
                            street      = :street,
                            town        = :town,
                            contactNum  = :contactNum
                        WHERE id = :id";

            $statement = $connection->prepare($sql);
            $statement->execute($user);

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    }
