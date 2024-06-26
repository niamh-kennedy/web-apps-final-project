<?php

/* reused code from sessions_lab */

    function clean ($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;

    }


    function loginWithDatabase ($connection, $email, $password) {

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result>0) {

            $_SESSION['Login'] = 'User';
            $id = $result['id'];
            $_SESSION['email']  = $email;
            $_SESSION['id']     = $id;
            $_SESSION['Active'] = true;
            $_SESSION['cartTotalQuantity'] = 0;

            return true;

        } else {

            return false;

        }

    }
