<?php
session_start();
if($_SESSION['Login'] !== 'User') {
    header("location:login.php");
    exit;
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['sku'] == $_GET['id']) {
                $_SESSION['cartTotalQuantity'] -= $value['quantity'];
                unset($_SESSION['cart'][$key]);
            }

            try {

                require_once '../database/connect.php';

                $id = $_GET['id'];

                $sql = "SELECT * FROM warehouse WHERE sku = :id";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();

                $item = $statement->fetch(PDO::FETCH_ASSOC);

                $increaseStock = $item["totalStock"] + $value['quantity'];

                $product = [
                    "sku" => $_GET["id"],
                    "totalStock" => $increaseStock
                ];

                $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

                $statement = $connection->prepare($sql);
                $statement->execute($product);

            } catch (PDOException $error) {

                echo $sql . "<br>" . $error->getMessage();

            }

        }
    }
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
                            <td class="text-center"><?php echo $value['quantity'];?></td>
                            <td class="text-center">€<?php echo $value['productPrice'];?></td>
                            <td class="text-center">€<?php echo number_format($value['productPrice'] * $value['quantity'], 2);?></td>
                            <td class="text-center"><a href="cart.php?action=remove&id=<?= $value["sku"];?>"><button class="btn btn-sm btn-outline-dark">Delete</button></a></td>
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
                    <a href="../app/complete-purchase.php">
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





<?php require_once '../app/templates/footer.php'; ?>