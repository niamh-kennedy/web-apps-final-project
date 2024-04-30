<?php

    session_start();

    require_once '../app/model/products.php';
    require_once '../src/session.php';
    require_once '../database/connect.php';

    if (isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $key => $value) {

                $_SESSION['cartTotalQuantity'] -= $value['quantity'];

                increaseStock($connection, $value['sku'], $value['quantity']);

                unset($_SESSION['cart'][$key]);

        }

    }

    $session = new session();
    $session->forgetSession();

?>
