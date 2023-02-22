<?php
include_once('header.php');
include_once('connection.php');
include_once('innerNav.php');
//include_once('includes/addPayment.php');
if(isset($_GET['inv_id'])){
    $inv_id = $_GET['inv_id'];
    $sql_stmt = $con->prepare("SELECT * FROM invoice WHERE invoice_id=?");
    $sql_stmt->bind_param("i", $inv_id);
    $sql_stmt->execute();
    $result = $sql_stmt->get_result();
    $invoiceList = $result->fetch_assoc();
    $client_id = $invoiceList["client_id"];
?>
<div class="container my-3 containerBg">
    <?php
        if(strtolower($invoiceList['status']) !== 'paid'){
            echo 
            '
            <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#payment">
                Add Payment
             </button>   
            ';
        }
    ?>
    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="successPay.php" method="post">
                        <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                        <div class="form-floating mb-3 ">
                            <input type="date" class="form-control" id="floatingInput"
                                value="<?php echo date('d-m-y');?>" name="date">
                            <label for="floatingInput">Date of payment</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="paymentType">
                                <option value="cash" selected>Cash</option>
                                <option value="check">Check</option>
                                <option value="bank">Bank Tranfer</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input type="number" class="form-control" id="floatingInput" name="amount"
                                value="<?php echo $invoiceList['amount'];?>" readonly>
                            <label for="floatingInput">Amount</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input type="text" class="form-control" id="floatingInput" name="notes">
                            <label for="floatingInput">Notes</label>
                        </div>
                        <button type="submit" class="btn btn-primary" name="successPay">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
        <div class="card mx-auto cardWidth">
            <div class="card-body">
                <div class="row mb-2 p-3">
                    <div class="col">
                        <div class="d-flex">
                            <?php
                                if(strtolower($invoiceList['status']) !== 'paid'){
                                    echo 
                                    '
                                    <span class="p-2 me-2 bg-warning">Draft</span>   
                                    ';
                                }else{
                                    echo 
                                    '
                                    <span class="p-2 me-2 bg-success text-white">Paid</span>   
                                    ';
                                }
                            ?>
                            <input type="text" class="form-control" value="INVOICE" readonly>
                            <input type="hidden" name="status" id="status" value="" readonly>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row p-3 customRow">
                    <div class="col-10 mb-2">
                        <input type="text" readonly class="form-control" name="description"
                            placeholder="Add Description" id="invoiceDesc">
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon2">#INV-</span>
                            <input type="text" readonly class="form-control" value="<?=$inv_id?>" name="invoice_id">
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
                                $sql_client = $con->prepare("SELECT * FROM clients WHERE client_id =?");
                                $sql_client->bind_param("i", $client_id);
                                $sql_client->execute();
                                $result_client = $sql_client->get_result();
                                $client = $result_client->fetch_assoc();
                                echo 
                                '
                                <p>'.$client["firstName"]." ".$client["lastName"].'</p>
                                ';
                            ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="invoiceDate" name="invoiceDate"
                                value="<?php echo $invoiceList['date'];?>" readonly>
                            <label for="invoiceDate">Date</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dueDate" name="dueDate"
                                value="<?php echo $invoiceList['duedate'];?>" readonly>
                            <label for="dueDate">Invoice Due</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="orderNumber" name="orderNumber" readonly>
                            <label for="orderNumber">Purchase Order Number
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row p-3">
                    <table class="table table-hover" id="invoiceItems">
                        <thead>
                            <tr>
                                <td width="50%">Description</td>
                                <td width="15%">Quantity</td>
                                <td width="15%">Rate</td>
                                <td width="15%">Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_items = $con->prepare("SELECT * FROM invoice_items WHERE invoice_id=?");
                                $sql_items->bind_param("i", $inv_id);
                                $sql_items->execute();
                                $result_items = $sql_items->get_result();
                                $itemsList = $result_items->fetch_all(MYSQLI_ASSOC);
                                foreach($itemsList as $item =>$value){
                                    // var_dump($value["item_name"]);
                                        echo 
                                        '
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" id="product_1"
                                                        placeholder="Item Name & Description" readonly name="itemName[]" value="'.$value["item_name"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" placeholder="Quantity" id="quantity_1"
                                                        name="itemQuantity[]" readonly value="'.$value["item_quantity"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" name="itemRate[]" placeholder="Rate"
                                                        id="rate_1" readonly value="'.$value["item_rate"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" name="itemAmt[]" placeholder="0.00"
                                                        id="amount_1" readonly value="'.$value["item_amount"].'">
                                                </div>
                                            </td>
                                        </tr>
                                        ';
                                    echo "<br/>";
                                }
                            ?>
                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" id="">Sub. Total </p>
                                    <input type="text" name="subTotal" id="st" class="px-3 form-control"
                                        style="width:130px;border:none;" readonly
                                        value="<?php echo $invoiceList['amount'];?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5">Tax</p>
                                    <input type="text" name="tax" id="taxValue" class="px-3 form-control"
                                        style="width:100px" readonly value="<?php echo $invoiceList['tax'];?>%">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Discount</p>
                                    <input type="text" name="discount" id="discountValue" class="px-3 form-control"
                                        style="width:100px" readonly value="<?php echo $invoiceList['discount']?>%">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Grand Total</p>
                                    <input type="text" name="grandTotal" id="gt" class="px-3 form-control
                                    <?php
                                        if(strtolower($invoiceList['status'] !== 'paid')){
                                            echo "bg-outline-danger";
                                        }else{ 
                                            echo "bg-success";
                                        }
                                    ?>
                                    " style="width:130px;border:none;" readonly
                                        value="<?php echo $invoiceList['amount'];?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                            name="notes" readonly><?php echo $invoiceList['notes'];?></textarea>
                        <label for="floatingTextarea">Invoice Note</label>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </form>

</div>
<?php
}
include_once('footer.php');
?>