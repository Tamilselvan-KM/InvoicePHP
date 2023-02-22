<?php
include_once('includes/header.php');
include_once('includes/connection.php');
include_once('includes/nav.php');
//include_once('includes/addPayment.php');
if(isset($_GET['q'])){
    $cid = $_GET['q'];
    $sql = "select * from invoice where client_id ='$cid' and status = 'draft'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row){
            if(strtolower($row['status'])=== 'draft'){
                $btn = '<button class="btn btn-warning">Pending</button>';
            }else{
                $btn = '<button class="btn btn-success">Paid</button>';
            }
            echo '<div class="card mx-auto" style="height:90px;width:500px">
            <div class="card-body d-flex justify-content-between">
                <div class="checkbox">
                    <a href="" class="btn" title="delete client">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
                <div class="clientInfo">
                    <p style="font-size:14px;">
                        <span>INV - '.$row['invoice_id'].'</span><br>
                        <span>Amount '.$row['amount'].'</span><br>
                    </p>
                </div>
                <div class="actions">
                '.$btn.'
                <a href="includes/invoicePay.php?inv_id='.$row['invoice_id'].'" target="_blank" title="view invoice" class="me-1 btn"><i class="fa-solid fa-eye"></i></a>
                <a href="editInvoice.php?inv_id='.$row['invoice_id'].'"  title="edit invoice" class="me-1 btn"><i class="fa-solid fa-pen-to-square"></i></a>
            </div>
        </div>
        <br/>
        ';
        
    }else{
        echo "<h2 class='text-center'>No Invoice Here! <br/> <a class='btn btn-success' href='./invoice.php'>Add New</a>";
    }
}else{
$sql_stmt = $con->prepare("SELECT * FROM invoice where status = 'draft'");
$sql_stmt->execute();
$result = $sql_stmt->get_result();
$invoiceList = $result->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <h3 class="text-center">Invoice List</h3>
    <?php
            if($invoiceList){
                foreach($invoiceList as $row){
                    if(strtolower($row['status'])=== 'draft'){
                        $btn = '<button class="btn btn-warning">Pending</button>';
                    }else{
                        $btn = '<button class="btn btn-success">Paid</button>';
                    }
                    echo '<div class="card mx-auto" style="height:90px;width:500px">
                    <div class="card-body d-flex justify-content-between">
                        <div class="checkbox">
                            <a href="" class="btn" title="delete client">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                        <div class="clientInfo">
                            <p style="font-size:14px;">
                                <span>INV - '.$row['invoice_id'].'</span><br>
                                <span>Amount '.$row['amount'].'</span><br>
                            </p>
                        </div>
                        <div class="actions">
                        '.$btn.'
                        <a href="includes/invoicePay.php?inv_id='.$row['invoice_id'].'" title="view invoice" class="me-1 btn"><i class="fa-solid fa-eye"></i></a>
                        <a href="editInvoice.php?inv_id='.$row['invoice_id'].'"  title="edit invoice" class="me-1 btn"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                </div>
                <br/>
                ';
                }
                //echo
                // '
                // <button type="button" class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#viewPayment">
                //     View Payment List
                // </button>
                // ';
            }else{
                echo "<h2 class='text-center'>No Invoice Here! <br/> <a class='btn btn-success' href='./invoice.php'>Add New</a>";

            }
            $sql_stmt->close();
            $con->close();
            
        ?>
</div>
<div class="modal fade" id="viewPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>hello</h3>
            </div>
        </div>
    </div>
</div>

<?php
}
include_once('includes/footer.php');