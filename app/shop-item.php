<?php /** @noinspection ALL */
session_start();


if (isset($_GET['id'])) {
    try {
        require_once '../database/connect.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM warehouse WHERE sku = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $item = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

if(isset($_POST['add-to-cart'])) {

    if(isset($_SESSION['Login'])== 'User') {

        if (isset($_SESSION['cart'])) {

            $session_array_id = array_column($_SESSION['cart'], 'sku');

            if (!in_array($_GET['id'], $session_array_id)) {
                $session_array = array(
                    'sku' => $_GET["id"],
                    'productName' => $item["productName"],
                    'quantity' => $_POST["quantity"],
                    'productPrice' => $item["productPrice"]
                );

                $_SESSION['cart'][] = $session_array;
                $_SESSION['cartTotalQuantity'] += $_POST['quantity'];
                $cartUpdated = "item(s) successfully added to cart!";

            } else {
                foreach ($_SESSION['cart'] as &$key) {
                    if ($key["sku"] == $_GET["id"]) {
                        $key['quantity'] += $_POST["quantity"];
                        $_SESSION['cartTotalQuantity'] += $_POST["quantity"];
                        $cartUpdated = "item(s) successfully added to cart!";
                        break;
                    }
                }
            }

            try {

                require_once '../database/connect.php';

                $lowerStock = $item["totalStock"] - $_POST['quantity'];

                $product = [
                    "sku" => $_GET["id"],
                    "totalStock" => $lowerStock
                ];

                $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

                $statement = $connection->prepare($sql);
                $statement->execute($product);

            } catch (PDOException $error) {

                echo $sql . "<br>" . $error->getMessage();

            }

        } else {
            $session_array = array(
                'sku' => $_GET["id"],
                'productName' => $item["productName"],
                'quantity' => $_POST["quantity"],
                'productPrice' => $item["productPrice"]
            );

            $_SESSION['cart'][] = $session_array;
            $_SESSION['cartTotalQuantity'] += $_POST['quantity'];
            $cartUpdated = "item(s) successfully added to cart!";

            try {

                require_once '../database/connect.php';

                $lowerStock = $item["totalStock"] - $_POST['quantity'];

                $product = [
                    "sku" => $_GET["id"],
                    "totalStock" => $lowerStock
                ];

                $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

                $statement = $connection->prepare($sql);
                $statement->execute($product);

            } catch (PDOException $error) {

                echo $sql . "<br>" . $error->getMessage();

            }
        }

    } else {

        header("location:login.php");
        exit;

    }
}

require_once '../app/templates/header.php';

if(isset($_SESSION['Login'])== 'User'){
    require_once '../app/templates/navbarUser.php';
} elseif(isset($_SESSION['Login'])== 'Admin'){
    require_once '../app/templates/navbarAdmin.php';
} else {
    require_once '../app/templates/navbar.php';
}

?>

            <!-- Page Title -->
            <title>Shop</title>
        </head>
    <body>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder"></h6>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-1 mb-5">
            <?php
            if(isset($cartUpdated)){ ?>
                <div class="pt-0 mb-3">
                    <?php
                        echo $_POST["quantity"] . " " . $cartUpdated;
                    ?>
                </div>
            <?php } ?>

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100 text-center">
                            <!-- Product image-->
                            <img class="card-img" src="../assets/img/product-<?php echo $item["sku"];?>.jpeg" alt="..." />
                        </div>
                    </div>
                    <div class="col col-xl-8 mb-5">
                        <div class="card h-100">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-left">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo ($item["productName"]); ?></h5>
                                    <!-- Product price-->
                                    <h6>€<?php echo ($item["productPrice"]); ?></h6>
                                    <!-- Product description-->
                                    <p><?php echo ($item["productDesc"]); ?></p>
                                </div>
                                <!-- Product action-->
                                <div class="border-top-0 bg-transparent row-cols-4">
                                    <form class="text-left d-grid" method="post" action="shop-item.php?id=<?= $item["sku"];?>">
                                        <input type="number" name="quantity" value="1" class="form-control row-cols-4">
                                        <input type="submit" name="add-to-cart" class="btn btn-outline-dark mt-sm-2" value="Add To Cart"></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php require_once '../app/templates/footer.php'; ?>