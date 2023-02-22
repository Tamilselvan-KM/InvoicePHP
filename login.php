<?php
include_once('includes/header.php');
?>
<div class="container my-3">
    <div class="row">
        <div class="col-lg-5 col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <p class="text-center fw-bolder fs-4">Login</p>
                        <hr class="hr">
                    </div>
                    <div class="my-2">
                        <span class="allError"></span>
                        <form action="" method="post" id="loginForm">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control email" id="floatingInput"
                                    placeholder="Enter Your Email" name="email">
                                <label for="floatingInput">Email Address</label>
                                <span class="emailError"></span>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control password" id="floatingInput1"
                                    placeholder="Enter Your Password" name="password">
                                <label for="floatingInput1">Password</label>
                                <span class="passError"></span>
                            </div>
                            <div class="mb-2">
                                <button type="submit" name="userLogBtn" class="btn btn-success w-100 text-uppercase"
                                    id="logBtn">Login</button>
                            </div>
                            <div class="text-center mt-2">
                                New User?<a href="register.php">Register Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./js/login.js"></script>
<?php
include_once('includes/footer.php');
?>