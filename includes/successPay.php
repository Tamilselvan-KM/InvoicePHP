<?php
session_start();
include_once 'connection.php';

if(isset($_POST['successPay'])){
    if($_POST['date']){
        $date = $_POST['date'];
    }else{
        $date = date('y-m-d');
    }
    $paymentType = $_POST['paymentType'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $client_id = $_POST['client_id']; 
    
    $sql_stmt = $con->prepare("INSERT INTO payment (client_id, receivedDate, payment_type, amount, notes)
            VALUES(?,?,?,?,?)");
$sql_stmt->bind_param("issds",$client_id,$date,$paymentType,$amount,$notes);
if($sql_stmt->execute()){
    // echo 1;
    $status = "paid";
    $upt_sql = $con->prepare("UPDATE invoice SET status=? WHERE client_id=? AND amount=?");
    $upt_sql->bind_param("sid", $status, $client_id,$amount);
    if($upt_sql->execute()){
        echo 
        '
        <script>
        alert("Payment Successfull..!");
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
        ';    }
}else{
    echo 
    '
    <script>
    alert("Some Error occured Try again later..!");
    location.href = "../main.php";
    </script>
    ';}
}