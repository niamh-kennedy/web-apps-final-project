<?php
session_start();
if($_SESSION['Login'] !== 'User') {
    header("location:login.php");
    exit;
}
require_once '../app/templates/header.php';
require_once '../app/templates/navbarUser.php';
?>

    <!-- Page Title -->
    <title>Cart</title>
    </head>
<body>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-left text-white">
            <h6 class="display-6 fw-bolder">Cart</h6>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5 p-md-5 p-xl-5">
    <div class="container px-5 px-lg-5">
        <div class="row gx-4 gx-lg-3 row-cols-1 row-cols-md-1 justify-content-center">
            <div class="flex-column py-xl-1">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-6">Product</th>
                        <th class="col-md-2">Quantity</th>
                        <th class="col-md-2">Price</th>
                        <th class="col-md-1 text-center">Edit</th>
                        <th class="col-md-1 text-center">Delete</th>
                    </tr>
                    </thead>

                    <!-- if cart has items in it, display in table-->
                    <?php if(!empty($_SESSION['cart'])) {
                        ?>

                    <tbody>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tbody>

                </table>
                <div class="d-flex flex-row-reverse">
                    <form method="post">
                        <a href="">
                            <button class="btn btn-outline-dark" name="Purchase" action="complete-purchase">Complete Purchase</button>
                        </a>
                    </form>
                </div>
                <?php } else { ?>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</section>



<?php require_once '../app/templates/footer.php'; ?>