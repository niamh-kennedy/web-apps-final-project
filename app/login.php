<?php
require_once('../src/functions.php');
$functions = new functions();
session_start();

require_once '../app/templates/header.php';
require_once '../app/templates/navbar.php';
?>

            <!-- Page Title -->
            <title>Login</title>
        </head>
    <body>

<!-- reused code from sessions_lab-->
<?php
    /* check if the login form has been submitted */
    if(isset($_POST['Submit'])) {

        try {
            require_once "../config/DBconnect.php";

            $email = ($_POST['Email']);
            $password = ($_POST['Password']);

            $sql = "SELECT * FROM final_project.users WHERE email = '$email' AND password = '$password'";
            $result = $connection->prepare($sql);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);


            if($row>0) {
                // Success: set session variables and redirect to protected page
                $_SESSION['firstName'] = $firstName; // store Username to the session
                $_SESSION['Active'] = true;
                header("location:../public/index.php");
                exit;
            } else {
                echo 'Incorrect Username or Password. Please try again.';
            }
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    ?>

    <!-- Header-->
    <header class="bg-pink py-5">
        <div class="container px-4 px-lg-5 my-0">

            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Login</h6>
            </div>

        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-5 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">

                <div class="col mb-5">
                    <!-- Login Form-->
                    <h5>Returning Customer</h5>
                    <form method="post" name="login_form" class="login-form">
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email address</label>
                            <input name="Email" type="email" class="form-control" id="emailInput" placeholder="name@example.com" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="passwordInput" class="form-label">Password</label>
                            <input name="Password" type="password" class="form-control" id="passwordInput" placeholder="Password" required>
                        </div>
                        <button class="btn btn-primary" name="Submit" value="Login" type="submit">Login</button>
                    </form>
                </div>

                <div class="col mb-5">
                    <!-- Call to Register-->
                    <h5>New Customer</h5>
                    <div class="mb-3">
                        Don't have an account yet? Create one now!
                    </div>
                    <button class="btn btn-primary" name="Submit" value="Register" type="submit">
                        <a href="../app/register.php">Register</a>
                    </button>
                </div>

            </div>
        </div>
    </section>

<?php require_once '../app/templates/footer.php'; ?>