<?php
session_start();
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    header("location:cart.php");
    exit;
}

require_once '../app/templates/header.php';

if(isset($_SESSION['Login'])== 'User'){
    require_once '../app/templates/navbarUser.php';
} elseif(isset($_SESSION['Login'])== 'Admin'){
    require_once '../app/templates/navbarAdmin.php';
} else {
    require_once '../app/templates/navbar.php';
}

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

    if(isset($_POST['confirm-transaction'])) {
        $orderSuccess = "Congatulations! Your order has been placed successfully. You will be notified when your order has shipped.";
    }

?>

    <!-- Page Title -->
    <title>My Account</title>
    </head>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Review Purchase Details</h6>
            </div>
        </div>
    </header>

    <body>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-1 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <?php
                        if(isset($orderSuccess)){
                            echo $orderSuccess;
                        }
                    ?>

                    <form>
                        <h4 class="pb-xl-1 pt-3">Delivery Information</h4>
                        <div class="flex-column py-xl-1">
                            <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                                <div class="col-md-6 form-inline">
                                    <b><label for="inputStreet">Name: </label></b>
                                    <em><?php echo ($user["firstName"]);?>, </em>
                                    <em><?php echo ($user["lastName"]);?></em>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                                <div class="col-md-6 form-inline">
                                    <b><label for="inputStreet">Address: </label></b>
                                    <em><?php echo ($user["street"]);?>, </em>
                                    <em><?php echo ($user["town"]);?></em>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                                <div class="col-md-6 form-inline">
                                    <b><label for="inputEmail">Email: </label></b>
                                    <em><?php echo ($user["email"]);?></em>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 py-xl-1 pb-xl-2 overflow-hidden">
                                <div class="col-md-6 form-inline">
                                    <b><label for="inputContactNum">Contact Number: </label></b>
                                    <em><?php echo ($user["contactNum"]);?></em>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 pt-3">
                    <h4 class="pb-xl-1">Items</h4>
                    <div class="flex-column py-xl-1">
                        <table class="table table-bordered table-striped">

                            <tr>
                                <th class="col-md-4">Product</th>
                                <th class="col-md-1 text-center">Quantity</th>
                                <th class="col-md-1 text-center">Price</th>
                                <th class="col-md-1 text-center">Total</th>
                            </tr>

                            <?php if(!empty($_SESSION['cart'])) {

                            $total = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            ?>

                            <tr>
                                <td class="col-md-4"><?php echo $value['productName'];?></td>
                                <td class="text-center"><?php echo $value['quantity'];?></td>
                                <td class="text-center">€<?php echo $value['productPrice'];?></td>
                                <td class="text-center">€<?php echo number_format($value['productPrice'] * $value['quantity'], 2);?></td>
                            </tr>

                            <?php

                            $total = $total + $value['productPrice'] * $value['quantity'];
                            }
                            ?>

                            <tr>
                                <td colspan="2"></td>
                                <td class="text-center"><b><em>Total Price:</em></b></td>
                                <td class="text-center"><em>€<?php echo number_format($total,2)?></em></td>
                            </tr>

                            <?php
                            } ?>

                        </table>

                        <div class="d-flex flex-row-reverse">
                            <form class="d-grid" method="post" action="complete-purchase.php?action=transaction-confirmed">
                                <input type="submit" name="confirm-transaction" class="btn btn-outline-dark"value="Confirm Transaction">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>


<?php require_once '../app/templates/footer.php'; ?>