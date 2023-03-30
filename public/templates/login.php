<?php
$pageTitle = "Login";
require_once __DIR__ . '/head.php';
?>

<body>
    <?php require_once __DIR__ . '/header.php';?>
<main>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Login</h5>
                    <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['message']; ?>
                        <?php unset($_SESSION['message']); ?>
                    </div>
                    <?php endif; ?>
                    <form method="POST" action="login.php">
                        <div class="form-floating mb-3">
                            <input type="text" name="username_or_email" id="username_or_email" class="form-control" placeholder="Username or Email" required autofocus>
                            <label for="username_or_email">Username or Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="text-center">
                            <a href="forgot_password.php">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php require_once __DIR__ . '/footer.php';?>
</body>