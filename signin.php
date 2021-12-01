<?php $doc = ["title" => "Doku - Sign in"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<link rel="stylesheet" href="includes/css/form.css">

<!-- Body HTML -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
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
            <div class="alert rounded-pill alert-danger mt-4 text-center" role="alert">
                Wrong username or password!
            </div>
        </div>
    </div>
</div>


<!-- End Body HTML -->
<?php require "includes/php/footer.php" ?>