<?php

    session_start();

    require_once '../app/view/templates/header.php';


    if(isset($_SESSION['Login']) && ($_SESSION['Login']) == 'User'){

        require_once '../app/view/templates/navbarUser.php';

    } else {

        require_once '../app/view/templates/navbar.php';

    }

?>

    <!-- Page Title -->
    <title>About Us</title>
    </head>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-left text-white">
                <h6 class="display-6 fw-bolder">About Us</h6>
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
                                    <em>Chariot Hillsberry</em>
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
                                    <h4 class="fw-bolder">Our Founder</h4><br>
                                    <!-- Biography-->
                                    With a career rooted in the artistry of makeup, Chariot Hillsberry has long been celebrated for her ability to enhance natural beauty and captivate audiences with her transformative creations. From dazzling red carpet looks to understated elegance, her talent knows no bounds.
                                    <br>
                                    <br>
                                    Driven by a passion for empowering individuals to feel confident and radiant in their own skin, Chariot embarked on a journey to create CH Cosmetics. Each product is meticulously crafted with the finest ingredients and infused with Chariot's signature touch of glamour and allure.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>


<?php require_once '../app/view/templates/footer.php'; ?>