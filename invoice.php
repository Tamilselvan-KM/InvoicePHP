<?php
include_once('includes/header.php');
include_once('includes/connection.php');
include_once('includes/nav.php');
$sql = "select invoice_id from invoice order by invoice_id desc";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
if($row){
    $num = $row[0] + 1;
}else{
    $num = 1;
}
?>
<div class="container my-3 containerBg">
    <form action="includes/invoiceInsert.php" method="post">
        <div class="card mx-auto cardWidth">
            <div class="card-body">
                <div class="row mb-2 p-3">
                    <div class="col">
                        <div class="d-flex">
                            <span class="p-2 me-2 textBackground">Draft</span><input type="text" class="form-control"
                                value="INVOICE">
                            <input type="hidden" name="status" id="status" value="draft">
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row p-3 customRow">
                    <div class="col-10 mb-2">
                        <input type="text" class="form-control" name="description" placeholder="Add Description"
                            id="invoiceDesc">
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon2">#INV-</span>
                            <input type="text" class="form-control" value="<?=$num?>" name="invoice_id">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row p-3 customRow">
                    <div class="col-6">
                        <h5>From</h5>
                        <div>
                            <?php
                                if(isset($_SESSION['userid'])){
                                    $id = $_SESSION['userid'];
                                    $sql = "select * from users where id='$id'";
                                    $result = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_row($result);
                                    echo $row[1];
                                    echo $row[5]."<br>";
                                    echo $row[6]." ".$row[7];
                            ?>
                            <input type="hidden" name="user_id" value="<?=$id;}?>">
                        </div>
                        <h5>To</h5>
                        <div class="form-floating mb-3 ">
                            <?php
                                if(isset($_GET['q'])){
                                    $cid = $_GET['q'];
                                    $sql = "select * from clients where client_id ='$cid'";
                                    $result = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if($row){
                                        echo 
                                        '
                                        <input type="search" class="form-control" id="clientName" name="clientName" 
                                        value="'.$row['firstName'].'">
                                        ';
                                    }
                                }else{
                                    echo 
                                    '
                                    <input type="search" class="form-control" id="clientName" name="clientName">
                                    <label for="clientName">Enter Client Name</label>
                                    ';
                                }
                            ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="invoiceDate" name="invoiceDate">
                            <label for="invoiceDate">Date</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dueDate" name="dueDate">
                            <label for="dueDate">Invoice Due</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="orderNumber" name="orderNumber">
                            <label for="orderNumber">Purchase Order Number
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row p-3">
                    <button type="button" class="btn btn-info my-2" style="width:50px" id="addRow"><i
                            class="fa-solid fa-plus"></i></button>

                    <table class="table table-hover" id="invoiceItems">
                        <thead>
                            <tr>
                                <td width="5%"></td>
                                <td width="50%">Description</td>
                                <td width="15%">Quantity</td>
                                <td width="15%">Rate</td>
                                <td width="15%">Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:#dc3545;padding:5px;" class="itemList"><i class="fa-solid fa-trash"
                                        style="margin:15px 0"></i>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="product_1"
                                            placeholder="Item Name & Description" name="itemName[]">
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" placeholder="Quantity" id="quantity_1"
                                            name="itemQuantity[]">
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" name="itemRate[]" placeholder="Rate"
                                            id="rate_1">
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" name="itemAmt[]" placeholder="0.00"
                                            id="amount_1" value="0">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" id="">Sub. Total </p>
                                    <input type="text" name="subTotal" id="st" class="px-3 form-control"
                                        style="width:130px;border:none;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Discount</p>
                                    <input type="number" name="discount" id="discountValue" class="px-3 form-control"
                                        style="width:100px">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5">Tax</p>
                                    <input type="number" name="tax" id="taxValue" class="px-3 form-control"
                                        style="width:100px">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Round Off</p>
                                    <input type="text" name="RoundTotal" id="rt" class="px-3 form-control"
                                        style="width:130px;border:none;" value="<?php //echo $invoiceList['amount'];?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Grand Total</p>
                                    <input type="text" name="grandTotal" id="gt" class="px-3 form-control"
                                        style="width:130px;border:none;">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                            name="notes"></textarea>
                        <label for="floatingTextarea">Invoice Note</label>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <button type="submit" id="cilentsBtn" class="btn btn-success" name="invoiceInsert">Save</button>
    </form>

</div>
<script src="./js/invoice.js"></script>
<?php
include_once('includes/footer.php');
?>