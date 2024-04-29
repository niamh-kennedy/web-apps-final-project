<?php
session_start();

require_once '../app/templates/header.php';

require_once('../src/functions.php');
$functions = new functions();

if(isset($_SESSION['Login'])== 'User'){

    require_once '../app/templates/navbarUser.php';

} elseif(isset($_SESSION['Login'])== 'Admin'){

    require_once '../app/templates/navbarAdmin.php';

} else {

    require_once '../app/templates/navbar.php';

}

if (isset($_POST['Update'])) {
    try {

        require_once '../database/connect.php';

        $id = $_SESSION['id'];

        $user =[
            "id"            => $id,
            "email"         => $functions->clean($_POST['inputEmail']),
            "password"      => $functions->clean($_POST['inputPassword']),
            "firstName"     => $functions->clean($_POST['inputFirstName']),
            "lastName"      => $functions->clean($_POST['inputLastName']),
            "street"        => $functions->clean($_POST['inputStreet']),
            "town"          => $functions->clean($_POST['inputTown']),
            "contactNum"    => $functions->clean($_POST['inputContactNum'])
        ];

        $sql = "UPDATE users
				SET id          = :id,
					email       = :email,
					password    = :password,
					firstName   = :firstName,
					lastName    = :lastName,
					street      = :street,
					town        = :town,
					contactNum  = :contactNum
				WHERE email = :email";

        $statement = $connection->prepare($sql);
        $statement->execute($user);

    } catch (PDOException $error) {

        echo $sql . "<br>" . $error->getMessage();

    }
}

if (isset($_POST['Delete'])) {
    try {

        require_once '../database/connect.php';

        $id = $_SESSION['id'];

        $sql = "DELETE FROM users WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header("Location: logout.php");
        exit;

    } catch (PDOException $error) {

        echo $sql . "<br>" . $error->getMessage();

    }
}

if (isset($_SESSION['email'])) {
    try {

        require_once '../database/connect.php';

        $email = $_SESSION['email'];

        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $error) {

        echo $sql . "<br>" . $error->getMessage();

    }
} else {

    echo "Something went wrong!";
    exit;

}

?>

    <!-- Page Title -->
    <title>My Account</title>
    </head>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Account Information</h6>
            </div>
        </div>
    </header>

<body>


<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-1 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php if (isset($_POST['Update']) && $statement) : ?>
                    <div class="col-lg-6 pb-xl-4">
                        <em><?php echo ($_POST['inputFirstName']); ?> successfully updated.</em>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <h4 class="pb-xl-1">Login Credentials</h4>
                    <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-4 overflow-hidden">
                        <div class="col-md-6">

                            <label for="inputEmail">Email</label>
                            <input name="inputEmail" type="email" class="form-control" id="inputEmail" value="<?php echo ($user["email"]);?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword">Password</label>
                            <input name="inputPassword" type="password" class="form-control" id="inputPassword" value="<?php echo ($user["password"]);?>" required>
                        </div>
                    </div>
                    <h4 class="pb-xl-1">Delivery Information</h4>
                    <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                        <div class="col-md-6">
                            <label for="inputFirstName">First Name</label>
                            <input name="inputFirstName" type="text" class="form-control" id="inputFirstName" value="<?php echo ($user["firstName"]);?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputLastName">Last Name</label>
                            <input name="inputLastName" type="text" class="form-control" id="inputLastName" value="<?php echo ($user["lastName"]);?>" required>
                        </div>
                    </div>
                    <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-4 overflow-hidden">
                        <div class="col-md-4">
                            <label for="inputStreet">Street</label>
                            <input name="inputStreet" type="text" class="form-control" id="inputStreet" value="<?php echo ($user["street"]);?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputTown">Town</label>
                            <input name="inputTown" type="text" class="form-control" id="inputTown" value="<?php echo ($user["town"]);?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputContactNum">Contact Number</label>
                            <input name="inputContactNum" type="text" class="form-control" id="inputContactNum" value="<?php echo ($user["contactNum"]);?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-grid">
                            <button class="btn btn-outline-dark" name="Update" type="submit">Update</button>
                        </div>
                    </div>
                </form>
                <form class="pt-5 py-2" method="post">
                    <div class="col-md-12">
                        <h6 class="pb-xl-1"><em>Want to delete your account, <?php echo ($user["firstName"]);?>?</em></h6>
                    </div>
                    <div class="col-md-12">
                        <div class="d-grid">
                            <button class="btn btn-sm btn-outline-dark" name="Delete" type="submit">Delete Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>


<?php require_once '../app/templates/footer.php'; ?>