<?php
    session_start();

    require_once '../app/view/templates/header.php';
    require_once '../app/model/products.php';
    require_once '../app/model/users.php';
    require_once '../src/functions.php';
    require_once '../database/connect.php';

    if(isset($_SESSION['Login'])== 'User'){

        require_once '../app/view/templates/navbarUser.php';

    } elseif(isset($_SESSION['Login'])== 'Admin'){

        require_once '../app/view/templates/navbarAdmin.php';

    } else {

        require_once '../app/view/templates/navbar.php';

    }

    /* check if the login form has been submitted */
    if(isset($_POST['Submit'])) {
        try {

            $email = clean($_POST['inputEmail']);
            $password = clean($_POST['inputPassword']);
            $firstName = clean($_POST['inputFirstName']);
            $lastName = clean($_POST['inputLastName']);
            $street = clean($_POST['inputStreet']);
            $town = clean($_POST['inputTown']);
            $contactNum = clean($_POST['inputContactNum']);

            createUser($connection, $email, $password, $firstName, $lastName, $street, $town, $contactNum);

            $userCreated = "success";
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    /* check if the login form has been submitted */
    if (isset($_POST['Submit']) && $userCreated ) {
        header("location:index.php?action=login");
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
                                <input name="inputFirstName" type="text" class="form-control" id="inputFirstName" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName">Last Name</label>
                                <input name="inputLastName" type="text" class="form-control" id="inputLastName" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-4 overflow-hidden">
                            <div class="col-md-4">
                                <label for="inputStreet">Street</label>
                                <input name="inputStreet" type="text" class="form-control" id="inputStreet" placeholder="Street" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputTown">Town</label>
                                <input name="inputTown" type="text" class="form-control" id="inputTown" placeholder="Town" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputContactNum">Contact Number</label>
                                <input name="inputContactNum" type="text" class="form-control" id="inputContactNum" placeholder="012 345 6789" required>
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

<?php require_once '../app/view/templates/footer.php'; ?>