<?php $doc = ["title" => "Doku - Sign Up"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<link rel="stylesheet" href="includes/css/form.css">

<!-- Body HTML -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="mt-5">
                <h3 class="fw-bold">New Account</h3>
                <p>Have an account? <a href="signin.php" class="text-decoration-none linkOrange">Log in</a> </p>
            </div>
            <div class="card shadow border-0 py-4 px-3">
                <div class="card-body">
                    <form action="includes/functionInstance.php" method="post">
                        <div class="mb-4">
                            <label for="instansName" class="form-label fw-bolder">Instance Name</label>
                            <input type="text" name="instansName" id="instansName" class="form-control" placeholder="Type your instance name" autocomplete="off" maxlength="50" autofocus required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bolder">Email</label>
                            <input type="mail" name="email" id="email" class="form-control" placeholder="Type your mail" autocomplete="off" maxlength="50" required>
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