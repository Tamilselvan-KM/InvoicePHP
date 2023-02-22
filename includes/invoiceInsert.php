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
        $sql = "INSERT INTO invoice(client_id, date, duedate, subTotal, amount, status,tax, discount, notes)VALUES('$cid', '$invoiceDate', '$dueDate','$subTotal', '$grandTotal', '$status','$tax','$discount', '$notes')";
        $result = mysqli_query($con, $sql);
        if($result){
            $idSql = "select invoice_id from invoice order by invoice_id desc";
            $idResult = mysqli_query($con, $idSql);
            $row = mysqli_fetch_row($idResult);
            if($row){
                $num = $row[0];
                foreach($itemName as $key => $value){
                    $itemSql = "INSERT INTO invoice_items(invoice_id,item_name, item_quantity, item_rate, item_amount)
                    VALUES('$num', '$value', '$itemQuantity[$key]', '$itemRate[$key]', '$itemAmt[$key]')";
                    $itemResult = mysqli_query($con, $itemSql);
                }
                if($itemResult){
                    echo 
                    '
                    <script>
                    alert("Saved Successfully..!");
                    location.href = "../viewInvoice.php";
                    </script>
                    ';
                }else{
                    echo 
                    '
                    <script>
                    alert("Some Error occured Try again later..!");
                    location.href = "../main.php";
                    </script>
                    ';
                }
            }else{
                // echo 'id not found';
                echo 
                '
                <script>
                alert("Some Error occured Try again later..!");
                location.href = "../main.php";
                </script>
                ';
            }
        }else{
            // echo 'error'.mysqli_error($con);
            echo 
            '
            <script>
            alert("Some Error occured Try again later..!");
            location.href = "../main.php";
            </script>
            ';
        }
    }
}