<?php
include_once('includes/header.php');
include_once('includes/connection.php');
include_once('includes/innerNav.php');
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
    ?>
    <form action="editInvoiceInsert.php" method="post">
        <div class="card mx-auto cardWidth">
            <div class="card-body">
                <div class="row mb-2 p-3">
                    <div class="col">
                        <div class="d-flex">
                            <span class="p-2 me-2 bg-warning">Draft</span>
                            <input type="text" class="form-control" value="INVOICE">
                            <input type="hidden" name="status" id="status" value="<?=$invoiceList['status']?>">
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
                            <input type="text" class="form-control" value="<?=$inv_id?>" name="invoice_id">
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
                                // echo 
                                // '
                                // <p>'.$client["firstName"]." ".$client["lastName"].'</p>
                                // ';
                            ?>
                            <input type="text" class="form-control" id="clientName" name="clientName"
                                value="<?php echo $client["firstName"];?>">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="invoiceDate" name="invoiceDate"
                                value="<?php echo $invoiceList['date'];?>">
                            <label for="invoiceDate">Date</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dueDate" name="dueDate"
                                value="<?php echo $invoiceList['duedate'];?>">
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
                            <?php
                                $sql_items = $con->prepare("SELECT * FROM invoice_items WHERE invoice_id=?");
                                $sql_items->bind_param("i", $inv_id);
                                $sql_items->execute();
                                $result_items = $sql_items->get_result();
                                $itemsList = $result_items->fetch_all(MYSQLI_ASSOC);
                                $item_amount = 0;
                                foreach($itemsList as $item =>$value){
                                    // var_dump($value["item_name"]);
                                    $count = $item;
                                    $count += 1;
                                        echo 
                                        '
                                        <tr>
                                            <td style="color:#dc3545;padding:5px;" class="itemList"><i class="fa-solid fa-trash"
                                                style="margin:15px 0"></i>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" id="product_'.(int)$count.'"
                                                        placeholder="Item Name & Description"   name="itemName[]" value="'.$value["item_name"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" placeholder="Quantity" id="quantity_'.(int)$count.'"
                                                        name="itemQuantity[]"   value="'.$value["item_quantity"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" name="itemRate[]" placeholder="Rate"
                                                        id="rate_'.$count.'"   value="'.$value["item_rate"].'">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" name="itemAmt[]" placeholder="0.00"
                                                        id="amount_'.$count.'"   value="'.$value["item_amount"].'">
                                                </div>
                                            </td>
                                        </tr>
                                        ';
                                        echo "<br/>";
                                        // $count += 1;
                                    }
                            ?>

                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" id="">Sub. Total </p>
                                    <input type="text" name="subTotal" id="st" class="px-3 form-control"
                                        style="width:130px;border:none;" value="<?=$invoiceList['subTotal']?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5" name="">Discount</p>
                                    <input type="text" name="discount" id="discountValue" class="px-3 form-control"
                                        style="width:100px" value="<?php echo $invoiceList['discount']?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <div class="d-flex justify-content-end">
                                    <p class="px-5">Tax</p>
                                    <input type="text" name="tax" id="taxValue" class="px-3 form-control"
                                        style="width:100px" value="<?php echo $invoiceList['tax'];?>">
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
                                        style="width:130px;border:none;" value="<?php echo $invoiceList['amount'];?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                            name="notes"><?php echo $invoiceList['notes'];?></textarea>
                        <label for="floatingTextarea">Invoice Note</label>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <button type="submit" id="cilentsBtn" class="btn btn-success" name="invoiceInsert">Update</button>
    </form>

</div>
<?php
}else{
    echo '<h2 class="text-center">Amount Already paid Can not update </h2>
    <a class="btn btn-success" href="./viewInvoice.php">Go back</a>
    ';   
}
}
?>
<script src="./js/invoiceEdit.js"></script>
<?php
include_once('includes/footer.php');
?>