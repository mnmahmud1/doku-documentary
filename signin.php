<?php $doc = ["title" => "Doku - Sign in"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<?php
    if(isset($_COOKIE["users"])){
        echo "
            <script>
                window.location.href = 'index.php';
            </script>
        ";
    }
?>

<link rel="stylesheet" href="includes/css/form.css">

<!-- Body HTML -->

<?php if(isset($_COOKIE["log"]) && $_COOKIE["log"] == "failed") : ?>
    <div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
        <div class="toast-container position-absolute top-0 end-0 p-3" id="toastPlacement">
            <div class="toast fade show">
                <div class="toast-header">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong class="me-auto">Attention!</strong>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Wrong username or password!
                </div>
            </div>
        </div>
    </div>

<?php elseif(isset($_COOKIE["reg"]) && $_COOKIE["reg"] == "success") :  ?>
    <div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
        <div class="toast-container position-absolute top-0 end-0 p-3" id="toastPlacement">
            <div class="toast fade show">
                <div class="toast-header">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong class="me-auto">Attention!</strong>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Successfully registered, sign in now!
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-4">
            <div class="mt-5">
                <h3 class="fw-bold">Sign in to Doku</h3>
                <p>Don't have account? <a href="signup.php" class="text-decoration-none linkOrange">Create an account.</a> </p>
            </div>
            <div class="card shadow border-0 py-4 px-3">
                <div class="card-body">
                    <form action="includes/php/functionInstance.php" method="post">
                        <div class="mb-4">
                            <label for="username" class="form-label fw-bolder">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Type your username" maxlength="30" autofocus required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bolder">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Type your password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-1" name="signin">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End Body HTML -->
<?php require "includes/php/footer.php" ?>