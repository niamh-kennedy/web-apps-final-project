<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php?action=homepage">CH Cosmetics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php?action=homepage">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=about">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?action=shop_all">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="index.php?action=shop_lipliner">Lip Liners</a></li>
                        <li><a class="dropdown-item" href="index.php?action=shop_lipstick">Lipsticks</a></li>
                        <li><a class="dropdown-item" href="index.php?action=shop_lipgloss">Lip Glosses</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex pe-3">
                <a class="btn btn-outline-dark" href="index.php?action=login" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </a>
            </form>
            <form class="d-flex">
                <a class="btn btn-outline-dark" href="index.php?action=login" type="submit">
                    Login
                </a>
            </form>
        </div>
    </div>
</nav>