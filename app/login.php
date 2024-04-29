<?php
session_start();

require_once '../app/templates/header.php';

require_once "../database/connect.php";
require_once('../src/functions.php');
$Clean = new Clean();
$userCheck = new LoginWithDatabase();

if(isset($_SESSION['Login'])== 'User'){

    require_once '../app/templates/navbarUser.php';

} elseif(isset($_SESSION['Login'])== 'Admin'){

    require_once '../app/templates/navbarAdmin.php';

} else {

    require_once '../app/templates/navbar.php';

}

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

            $email      = $Clean->clean($_POST['inputEmail']);
            $password   = $Clean->clean($_POST['inputPassword']);

            $user = $userCheck->loginWithDatabase($connection, $email, $password);

            if($user === true) {
                header("location:../public/index.php");
                exit;
            } else {
                $loginFailure = 'Incorrect Username or Password. Please try again.';
            }

        } catch (PDOException $error) {

            echo $sql . "<br>" . $error->getMessage();

        }
    }

    ?>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Login</h6>
            </div>
        </div>
    </header>



    <!-- Section-->
    <section class="py-5">
        <div class="container px-5 px-lg-5 mt-1 mb-5">
            <?php if(isset($loginFailure)){ ?>
                <div class="col mb-5">
                    <?php echo $loginFailure; ?>
                </div>
            <?php } ?>
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <!-- Login Form-->
                    <h5>Returning Customer</h5>
                    <form action="" method="post" name="login_form" class="login-form">
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input name="inputEmail" type="email" class="form-control" id="inputEmail" placeholder="name@example.com" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input name="inputPassword" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                        </div>
                        <button class="btn btn-outline-dark" type="submit" name="Submit" value="Submit">Login</button>
                    </form>
                </div>

                <div class="col mb-5">
                    <!-- Call to Register-->
                    <h5>New Customer</h5>
                    <div class="mb-3">
                        Don't have an account yet?
                    </div>
                        <a href="../app/register.php">
                            <button class="btn btn-outline-dark">Register</button>
                        </a>
                </div>

            </div>
        </div>
    </section>

<!-- Footer-->
<?php require_once '../app/templates/footer.php'; ?>