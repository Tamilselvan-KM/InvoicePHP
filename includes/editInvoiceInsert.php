<?php
session_start();
include_once 'connection.php';

if(isset($_POST['invoiceInsert'])){
    // print_r($_POST);
    $status = $_POST['status'];
    $invoice_id = $_POST['invoice_id'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];
    $clientName = $_POST['clientName'];
    if($_POST['invoiceDate']){
        $invoiceDate = $_POST['invoiceDate'];
    }else{
        $invoiceDate = date('y-m-d');
    }
    if($_POST['dueDate']){
        $dueDate = $_POST['dueDate'];
    }else{
        $dueDate = date('y-m-d');
    }
    $orderNumber = $_POST['orderNumber'];
    $itemName = $_POST['itemName'];
    $itemQuantity = $_POST['itemQuantity'];
    $itemRate = $_POST['itemRate'];
    $itemAmt = $_POST['itemAmt'];
    $subTotal = $_POST['subTotal'];
    $tax = $_POST['tax'];
    $discount = $_POST['discount'];
    $grandTotal = $_POST['grandTotal'];
    $notes = $_POST['notes'];

    //print_r($_POST);


    $sql = "select * from clients where firstName='$clientName'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row){
        $cid =  $row['client_id'];
        $sql = "UPDATE invoice SET
        client_id = '$cid', 
        date = '$invoiceDate', 
        duedate = '$dueDate', 
        amount = '$grandTotal', 
        status = '$status',
        tax = '$tax', 
        discount '$discount', 
        notes ='$notes'";
        $result = mysqli_query($con, $sql);
        if($result){
            $idSql = "select invoice_id from invoice order by invoice_id desc";
            $idResult = mysqli_query($con, $idSql);
            $row = mysqli_fetch_row($idResult);
            if($row){
                $num = $row[0];
                foreach($itemName as $key => $value){
                    $itemSql = "UPDATE invoice_items SET 
                    invoice_id='$num',
                    item_name='$value', 
                    item_quantity='$itemQuantity[$key]', 
                    item_rate = '$itemRate[$key]',
                    item_amount = '$itemAmt[$key]'";
                    $itemResult = mysqli_query($con, $itemSql);
                }
                if($itemResult){
                    echo 
                    '
                    <script>
                    alert("Updated Successfully..!");
                    location.href = "../viewInvoice.php";
                    </script>
                    ';
                }else{
                    echo 
                    '
                    <script>
                    alert("Some Error occured Try again later..! 2");
                    location.href = "../main.php";
                    </script>
                    ';
                }
            }else{
                // echo 'id not found';
                echo 
                '
                <script>
                alert("Some Error occured Try again later..! 1");
                location.href = "../main.php";
                </script>
                ';
            }
        }else{
            // echo 'error'.mysqli_error($con);
            echo 
            '
            <script>
            alert("Some Error occured Try again later..! 0");
            location.href = "../main.php";
            </script>
            ';
        }
    }
}