<?php
 function register(){
    echo '  
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-5 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <p class="text-center fw-bolder fs-4">Register</p>
                            <hr class="hr">
                        </div>
                        <div class="my-2">
                            <span class="allError"></span>
                            <form action="" method="post" id="registerForm">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control firstName" id="floatingInput"
                                                placeholder="Enter Your First Name" name="firstName">
                                            <label for="floatingInput">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control lastName" id="floatingInput1"
                                                placeholder="Enter Your Last Name" name="lastName">
                                            <label for="floatingInput1">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control email" id="floatingInput2"
                                        placeholder="Enter Your Email" name="email">
                                    <label for="floatingInput2">Email Address</label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control password" id="floatingInput3"
                                                placeholder="Enter Your Password" name="password">
                                            <label for="floatingInput3">Password</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control confirmPassword" id="floatingInput4"
                                                placeholder="Enter Confirm Password">
                                            <label for="floatingInput4" name="confirmPassword">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control address" id="floatingInput5"
                                        placeholder="Enter Your Address" name="address">
                                    <label for="floatingInput5">Address</label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control city" id="floatingInput6"
                                            placeholder="Enter Your Address" name="city">
                                         <label for="floatingInput6">City</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                         <div class="form-floating mb-3">
                                            <input type="text" class="form-control postalCode" id="floatingInput7"
                                                placeholder="Enter Your " name="postalCode">
                                            <label for="floatingInput7">Postal Code</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <select id="inputState" class="form-select state" name="state">
                                                <!-- <option selected>Choose...</option> -->
                                                <option value="tn" selected>Tamil Nadu</option>
                                                <option value="ap">Andra Pradesh</option>
                                                <option value="kl">Kerala</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                                <select id="inputState2" class="form-select country" name="country">
                                                <!-- <option selected>Choose...</option> -->
                                                <option value="india" selected>India</option>
                                                <option value="usa">USA</option>
                                                <option value="aus">Austrilla</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <button type="submit" name="userBtn" class="btn btn-success w-100 text-uppercase">Register</button>
                                </div>
                                <div class="text-center my-2">
                                    Already an  User?<a href="login.php">Login Here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

if(isset($_POST['userBtn'])){
    $firstName = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $email     = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    
}