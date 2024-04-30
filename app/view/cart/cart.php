<?php

    session_start();

    if($_SESSION['Login'] !== 'User') {
        header("location:login.php");
        exit;
    }


    require_once '../database/connect.php';
    require_once '../app/model/products.php';
    require_once '../src/functions.php';


    if (isset($_POST['remove'])) {

        foreach ($_SESSION['cart'] as $key => $value) {

            if ($value['sku'] == $_GET['id']) {

                $_SESSION['cartTotalQuantity'] -= $value['quantity'];

                increaseStock($connection, $_GET['id'], $value['quantity']);

                unset($_SESSION['cart'][$key]);

            }

        }

    }

    if (isset($_POST['edit'])) {

    }

    require_once '../app/view/templates/header.php';
    require_once '../app/view/templates/navbarUser.php';

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
            <div class="row gx-4 gx-lg-3 row-cols-2 row-cols-md-1 justify-content-center">
                <div class="flex-column py-xl-1">
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th class="col-md-4">Product</th>
                            <th class="col-md-1 text-center">Quantity</th>
                            <th class="col-md-1 text-center">Price</th>
                            <th class="col-md-1 text-center">Total</th>
                            <th class="col-md-1 text-center">Delete</th>
                        </tr>


                        <!-- if cart has items in it, display in table-->
                        <?php if(!empty($_SESSION['cart'])) {

                            $total = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            ?>

                            <tr>
                                <td class="col-md-4"><?php echo $value['productName'];?></td>
                                <td class="text-center">
                                    <?php echo $value['quantity'];?>
                                </td>
                                <td class="text-center">€<?php echo $value['productPrice'];?></td>
                                <td class="text-center">€<?php echo number_format($value['productPrice'] * $value['quantity'], 2);?></td>
                                <td class="text-center">
                                    <form method="post" action="index.php?action=cart&id=<?php echo $value['sku']; ?>">
                                        <input type="submit" name="remove" class="btn btn-sm btn-outline-dark" value="Delete">
                                    </form>
                                </td>
                            </tr>

                            <?php

                                $total = $total + $value['productPrice'] * $value['quantity'];


                            }
                            ?>

                            <tr>
                                <td colspan="2"></td>
                                <td class="text-center"><b><em>Total Price:</em></b></td>
                                <td class="text-center"><em>€<?php echo number_format($total,2)?></em></td>
                                <td></td>
                            </tr>

                    </table>

                    <div class="d-flex flex-row-reverse">
                        <a href="index.php?action=complete_purchase">
                            <button class="btn btn-outline-dark">Complete Purchase</button>
                        </a>
                    </div>

                            <?php
                        } else { ?>

                            <tr>
                                <td class="col-md-4"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>

                            <tr>
                                <td colspan="2"></td>
                                <td class="text-center"><b><em>Total Price:</em></b></td>
                                <td class="text-center"><em>€0.00</em></td>
                                <td></td>
                            </tr>
                        </table>
                        <?php } ?>


                </div>
            </div>
        </div>
    </section>


<?php require_once '../app/view/templates/footer.php'; ?>