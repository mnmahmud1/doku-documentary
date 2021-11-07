<?php $doc = ["title" => "Instance Sign in"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<link rel="stylesheet" href="includes/css/form.css">

<!-- Body HTML -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="mt-5">
                <h3 class="fw-bold">Sign in</h3>
                <p>Don't have account? <a href="#" class="text-decoration-none linkOrange">Register Now</a> </p>
            </div>
            <div class="card shadow-lg border-0 py-3 px-3">
                <div class="card-body">
                    <form action="includes/functionInstance.php" method="post">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Type your username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
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