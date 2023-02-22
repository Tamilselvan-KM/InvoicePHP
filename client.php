<?php
include_once('includes/header.php');
include_once('includes/nav.php');
?>
<div class="container my-3">
    <span class="allError"></span>
    <form action="" method="post" id="clientRegisterForm">
        <div class="row my-2">
            <div class="col-lg-8 col-md-8 mx-auto">
                <div class="card">
                    <div class="card-title m-2">
                        <h4 class="p-1 textBackground">Basic Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control firstName" id="floatingInput"
                                        placeholder="Enter Your First Name" name="firstName">
                                    <label for="floatingInput">First Name*</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control lastName" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="lastName">
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control email" id="floatingInput"
                                        placeholder="Enter Your First Name" name="email">
                                    <label for="floatingInput">Email*</label>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-lg-8 col-md-8 mx-auto">
                <div class="card">
                    <div class="card-title m-2">
                        <h4 class="p-1 textBackground">Address</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control city" id="floatingInput"
                                        placeholder="Enter Your First Name " name="city">
                                    <label for="floatingInput">City</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control postalCode" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="postalCode">
                                    <label for="floatingInput">Postal Code</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control state" id="floatingInput"
                                        placeholder="Enter Your First Name " name="state">
                                    <label for="floatingInput">State</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <select id="inputState" class="form-select country" name="postalCode">
                                        <!-- <option selected>Choose...</option> -->
                                        <option value="india" selected>India</option>
                                        <option value="usa">USA</option>
                                        <option value="aus">Austrilla</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control address" id="floatingInput"
                                placeholder="Enter Your Last Name " name="postalCode">
                            <label for="floatingInput">Address</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-lg-8 col-md-8 mx-auto">
                <div class="card">
                    <div class="card-title m-2">
                        <h4 class="p-1 textBackground">Additional Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control phoneNumber" id="floatingInput"
                                        placeholder="Enter Your First Name " name="city">
                                    <label for="floatingInput">Phone Number*</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control taxNumber" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="postalCode">
                                    <label for="floatingInput">Tax Number*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea class="form-control notes" placeholder="Leave a comment here"
                                        id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Notes</label>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="cilentBtn" class="btn btn-success">Save</button>
    </form>
</div>
<script src="./js/client.js"></script>
<?php
include_once('includes/footer.php');
?>