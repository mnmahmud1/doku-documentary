<?php $doc = ["title" => "Doku - Sign Up"] ?>
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

<?php if(isset($_COOKIE["reg"]) && $_COOKIE["reg"] == "failedUsername") : ?>
    <div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
        <div class="toast-container position-absolute top-0 end-0 p-3" id="toastPlacement">
            <div class="toast fade show">
                <div class="toast-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                    <strong class="me-auto">Attention!</strong>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <strong>Username was used on another users</strong>, please create your unique username!
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-7">
            <div class="mt-5">
                <h3 class="fw-bold">Create New Account</h3>
                <p>Have an account? <a href="signin.php" class="text-decoration-none linkOrange">Sign in</a> </p>
            </div>
            <div class="card shadow border-0 py-4 px-3">
                <div class="card-body">
                    <form action="includes/php/functionInstance.php" method="post">
                        <div class="mb-4">
                            <label for="instansName" class="form-label fw-bolder">Instance Name</label>
                            <input type="text" name="instansName" id="instansName" class="form-control" placeholder="Type your instance name" autocomplete="off" maxlength="50" autofocus required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bolder">Email</label>
                            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Type your mail" autocomplete="off" maxlength="50" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="mb-4">
                                    <label for="username" class="form-label fw-bolder">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" maxlength="30" autocomplete="off" placeholder="Create username" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bolder">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Create password" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="mb-4">
                                    <label for="repassword" class="form-label fw-bolder">Repeat Password</label>
                                    <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Repeat password" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-1" name="signup" id="signup">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(':input[type="submit"]').prop('disabled', true);

        $('#password, #repassword').keyup(function() {
            if($("#password").val() == "" && $("#repassword").val() == "") {
                $(':input[type="submit"]').prop('disabled', true);
            } else if ($("#password").val() == $("#repassword").val()) {
                $(':input[type="submit"]').prop('disabled', false);
            } else {
                $("#signup").prop("disabled", true);
            }
        });
    });
</script>


<!-- End Body HTML -->
<?php require "includes/php/footer.php" ?>