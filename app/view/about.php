<?php

    session_start();

    require_once '../app/view/templates/header.php';


    if(isset($_SESSION['Login']) && ($_SESSION['Login']) == 'User'){

        require_once '../app/view/templates/navbarUser.php';

    } elseif(isset($_SESSION['Login']) && ($_SESSION['Login']) == 'Admin'){

        require_once '../app/view/templates/navbarAdmin.php';

    } else {

        require_once '../app/view/templates/navbar.php';

    }

?>

    <!-- Page Title -->
    <title>About</title>
    </head>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">Our Story</h6>
            </div>
        </div>
    </header>

    <body>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-1 mb-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-1 row-cols-xl-3 justify-content-center">
                    <div class="col">
                        <div class="card h-100">
                            <!-- Owner headshot -->
                            <img class="card-img-top" src="../assets/img/founder-headshot.jfif" alt="..." />
                            <!-- Paragraph-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Owner name-->
                                    Chariot Hillsberry
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <!-- Paragraph-->
                            <div class="card-body p-4">
                                <div class="text-left">
                                    <!-- Owner name-->
                                    <h5 class="fw-bolder"></h5>
                                    <!-- Biography-->
                                    Insert paragraph about owner here
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>


<?php require_once '../app/view/templates/footer.php'; ?>