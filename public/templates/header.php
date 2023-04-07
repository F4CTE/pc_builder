<header class='sticky-top'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PC Builder</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php

                    use App\User\UserPdo;

                    if (isset($_SESSION['user']) && $_SESSION['isAdmin'] && $pageTitle !== 'Admin Panel') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($pageTitle !== 'Build') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="build.php">Build</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($pageTitle !== 'Parts') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="parts.php">Parts</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($pageTitle !== 'Register' && !isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">register</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($pageTitle !== 'Login' && !isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="dropdown-center">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?php echo (new UserPdo())->getById($_SESSION['user'])->getUsername(); ?>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="builds.php">My Builds</a></li>
                                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>