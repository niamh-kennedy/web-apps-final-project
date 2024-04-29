<?php
session_start();
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

    $sql = "SELECT * FROM warehouse WHERE productCategory = 'lipliner'";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . error->getMessage();
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
                <h6 class="display-6 fw-bolder">Lip Liners</h6>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($result as $row) :?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="../assets/img/product-<?php echo $row["sku"];?>.jpeg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo ($row["productName"]); ?></h5>
                                    <!-- Product price-->
                                    €<?php echo ($row["productPrice"]); ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="../app/shop-item.php?id=<?php echo $row["sku"];?>">View Product</a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>



<?php require_once '../app/templates/footer.php'; ?>