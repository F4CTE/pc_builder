<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PC Builder</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['isAdmin']) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <?php if ((basename($_SERVER['PHP_SELF']) !== 'register.php') && !isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">register</a>
                    </li>
                    <?php endif;?>

                    <?php if ((basename($_SERVER['PHP_SELF']) !== 'login.php') && !isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">login</a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
</header>