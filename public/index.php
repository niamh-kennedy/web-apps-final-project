<?php

    /* Header */
    require_once '../app/view/templates/header.php';

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    switch ($action) {

        case 'homepage':
            require_once __DIR__ . '/../app/view/homepage.php';
            break;

        case 'about':
            require_once __DIR__ . '/../app/view/about.php';
            break;

        case 'shop_all':
            require_once __DIR__ . '/../app/view/shop/shop-all.php';
            break;

        case 'shop_lipliner':
            require_once __DIR__ . '/../app/view/shop/shop-lipliner.php';
            break;

        case 'shop_lipstick':
            require_once __DIR__ . '/../app/view/shop/shop-lipstick.php';
            break;

        case 'shop_lipgloss':
            require_once __DIR__ . '/../app/view/shop/shop-lipgloss.php';
            break;

        case 'shop_item':
            include __DIR__ . "/../app/view/shop/shop-item.php";
            break;

        case 'cart':
            require_once __DIR__ . '/../app/view/cart/cart.php';
            break;

        case 'complete_purchase':
            require_once __DIR__ . '/../app/view/cart/complete-purchase.php';
            break;

        case 'login':
            require_once __DIR__ . '/../app/view/user/login.php';
            break;

        case 'register':
            require_once __DIR__ . '/../app/view/user/register.php';
            break;

        case 'user_account':
            require_once __DIR__ . '/../app/view/user/account.php';
            break;

        case 'logout':
            require_once __DIR__ . '/../app/view/user/logout.php';
            break;

        default:
            require_once __DIR__ . '/../app/view/homepage.php';
    }

    /* Footer */
    require_once '../app/view/templates/header.php';