<?php

require_once '../public/templates/header.php';?

?>


/* reused code from sessions_lab */
<?php
    /* check if the login form has been submitted */
    if(isset($_POST['Submit'])) {
        try {
            require_once "../src/db_connect.php";

            /* sanitize user input */
            $username = $functions->clean($_POST['Username']);
            $password = $functions->clean($_POST['Password']);

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $connection->prepare($sql);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);

            if($row>0) {
                // Success: set session variables and redirect to protected page
                $_SESSION['Username'] = $username; // store Username to the session
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit;
            } else {
                echo 'Incorrect Username or Password';
            }
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
?>


<?php require_once '../public/templates/footer.php';? ?>