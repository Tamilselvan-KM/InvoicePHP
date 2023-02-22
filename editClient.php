<?php
include_once('includes/header.php');
include_once('includes/connection.php');
include_once('includes/nav.php');
if(isset($_GET['cid'])){
    $id = $_GET['cid'];
    $sql_stmt = $con->prepare("SELECT * FROM clients WHERE client_id = '$id'");
    $sql_stmt->execute();
    $result = $sql_stmt->get_result();
    $user = $result->fetch_assoc();
    if($user){
        $clientid  = $user['client_id'];
        $firstName = $user['firstName'];
        $lastName  = $user['lastName'];
        $email     = $user['email'];
        $address   = $user['address'];
        $city      = $user['city'];
        $postalCode= $user['postalCode'];
        $state     = $user['state'];
        $country   = $user['country'];
        $phone = $user['contact'];
        $taxNumber =$user['taxNumber'];
        $notes = $user['notes'];
?>
<div class="container my-3">
    <span class="allError"></span>
    <form action="" method="post" id="clientEditForm">
        <input type="hidden" name="userid" id="clientId" value="<?=$clientid?>">
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
                                        placeholder="Enter Your First Name" name="firstName" value=<?=$firstName?>>
                                    <label for="floatingInput">First Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control lastName" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="lastName" value=<?=$lastName?>>
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control email" id="floatingInput"
                                        placeholder="Enter Your First Name" name="email" value=<?=$email?>>
                                    <label for="floatingInput">Email</label>
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
                                        placeholder="Enter Your First Name " name="city" value=<?=$city?>>
                                    <label for="floatingInput">City</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control postalCode" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="postalCode" value=<?=$postalCode?>>
                                    <label for="floatingInput">Postal Code</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control state" id="floatingInput"
                                        placeholder="Enter Your First Name " name="state" value=<?=$state?>>
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
                                placeholder="Enter Your Last Name " name="postalCode" value=<?=$address?>>
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
                                        placeholder="Enter Your First Name " name="city" value=<?=$phone?>>
                                    <label for="floatingInput">Phone Number</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control taxNumber" id="floatingInput"
                                        placeholder="Enter Your Last Name " name="postalCode" value=<?=$taxNumber?>>
                                    <label for="floatingInput">Tax Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea class="form-control notes" placeholder="Leave a comment here"
                                        id="floatingTextarea"><?=$notes?></textarea>
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
        <button type="submit" class="btn btn-success" id="cilentBtn">Update</button>
    </form>
</div>
<?php
    }
}
?>
<script src="./js/clientEdit.js"></script>
<?php
include_once('includes/footer.php');
?>