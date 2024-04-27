<?php
require_once('../src/functions.php');
$functions = new functions();
require_once '../app/templates/header.php';
require_once '../app/templates/navbar.php';
?>


<?php
/* check if the login form has been submitted */
if(isset($_POST['Submit'])) {
    try {
        require_once "../config/DBconnect.php";

        $new_user = array (
            "firstName" => ($_POST['inputFirstName']),
            "lastName" => ($_POST['inputLastName']),
            "email" => ($_POST['inputEmail']),
            "password" => ($_POST['inputPassword']),
            "street" => ($_POST['inputStreet']),
            "town" => ($_POST['inputTown']),
            "contactNum" => ($_POST['inputContactNum'])
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
    <header class="bg-pink py-5">
        <div class="container px-4 px-lg-1 my-0">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Register</h6>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5 px-2">
        <div class="container px-2 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                <!-- Registration Form-->
                <div class="col mb-5">
                    <form method="post" name="registration_form" class="registration-form">
                        <div class="form-row">
                            <div class="form-group form-control-sm">
                                <label for="inputEmail">Email</label>
                                <input name="inputEmail" type="email" class="form-control" id="inputEmail" placeholder="example@hotmail.com" required>
                            </div>
                            <div class="form-group form-control-sm">
                                <label for="inputPassword">Password</label>
                                <input name="inputPassword" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-control-sm">
                                <label for="inputFirstName">First Name</label>
                                <input name="inputFirstName" type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                            </div>
                            <div class="form-group form-control-sm">
                                <label for="inputLastName">Last Name</label>
                                <input name="inputLastName" type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row form-check-inline">
                            <div class="form-group form-control-sm">
                                <label for="inputStreet">Street</label>
                                <input name="inputStreet" type="text" class="form-control" id="inputStreet" placeholder="Street">
                            </div>
                        </div>
                        <div class="form-row form-check-inline">
                            <div class="form-group form-control-sm">
                                <label for="inputTown">Town</label>
                                <input name="inputTown" type="text" class="form-control" id="inputTown" placeholder="Town">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-check-inline form-control-sm">
                                <label for="inputContactNum">Contact Number</label>
                                <input name="inputContactNum" type="text" class="form-control" id="inputContactNum" placeholder="012 345 6789">
                            </div>
                        </div>
                        <div class="form-row form-check-inline">
                            <div class="form-group form-control-lg">
                            <button class="btn btn-primary" name="Submit" value="Register" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php require_once '../app/templates/footer.php'; ?>