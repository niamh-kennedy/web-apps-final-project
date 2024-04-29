<?php
session_start();

require_once '../app/templates/header.php';

require_once('../src/functions.php');
$Clean = new Clean();

require_once '../app/templates/navbar.php';

?>


<?php
/* check if the login form has been submitted */
if(isset($_POST['Submit'])) {
    try {
        require_once "../database/connect.php";

        $new_user = array (
            "firstName"     => $Clean->clean($_POST['inputFirstName']),
            "lastName"      => $Clean->clean($_POST['inputLastName']),
            "email"         => $Clean->clean($_POST['inputEmail']),
            "password"      => $Clean->clean($_POST['inputPassword']),
            "street"        => $Clean->clean($_POST['inputStreet']),
            "town"          => $Clean->clean($_POST['inputTown']),
            "contactNum"    => $Clean->clean($_POST['inputContactNum'])
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

/* check if the login form has been submitted */
if (isset($_POST['Submit']) && $statement ) {
    header("location:login.php");
    exit;
}
?>

    <!-- Page Title -->
    <title>Register</title>
    </head>
    <body>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Register</h6>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5 p-md-5 p-xl-5">
        <div class="container px-5 px-lg-5">
            <div class="row gx-4 gx-lg-3 row-cols-1 row-cols-md-2 justify-content-center">
                <div class="flex-column py-xl-1 justify-content-between">
                    <!-- Registration Form-->
                    <form method="post">
                        <h4 class="pb-xl-1">Login Credentials</h4>
                        <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-4 overflow-hidden">
                            <div class="col-md-6">
                                <label for="inputEmail">Email</label>
                                <input name="inputEmail" type="email" class="form-control" id="inputEmail" placeholder="example@hotmail.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword">Password</label>
                                <input name="inputPassword" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                            </div>
                        </div>
                        <h4 class="pb-xl-1">Delivery Information</h4>
                        <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                            <div class="col-md-6">
                                <label for="inputFirstName">First Name</label>
                                <input name="inputFirstName" type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName">Last Name</label>
                                <input name="inputLastName" type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-4 overflow-hidden">
                            <div class="col-md-4">
                                <label for="inputStreet">Street</label>
                                <input name="inputStreet" type="text" class="form-control" id="inputStreet" placeholder="Street">
                            </div>
                            <div class="col-md-4">
                                <label for="inputTown">Town</label>
                                <input name="inputTown" type="text" class="form-control" id="inputTown" placeholder="Town">
                            </div>
                            <div class="col-md-4">
                                <label for="inputContactNum">Contact Number</label>
                                <input name="inputContactNum" type="text" class="form-control" id="inputContactNum" placeholder="012 345 6789">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button class="btn btn-outline-dark" name="Submit" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php require_once '../app/templates/footer.php'; ?>