<?php
$pageTitle = "Register";
require_once __DIR__ . '/head.php';
?>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <main>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card my-5">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">Register</h5>
                            <?php if (isset($_SESSION['error'])) : ?>
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['error']; ?>
                                    <?php unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['message']; ?>
                                    <?php unset($_SESSION['message']); ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="register.php">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <?php require_once __DIR__ . '/footer.php'; ?>
</body>