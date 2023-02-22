<?php
session_start();
include_once 'includes/connection.php';

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
        subTotal = '$subTotal',
        amount = '$grandTotal', 
        status = '$status',
        tax = '$tax', 
        discount = '$discount', 
        notes ='$notes'
        WHERE invoice_id = '$invoice_id'
        ";
        $result = mysqli_query($con, $sql);
        if($result){
            var_dump($result);
            $delSql = "DELETE FROM invoice_items WHERE item_id IN (SELECT item_id FROM invoice_items WHERE invoice_id = '$invoice_id')";
            $delRes = mysqli_query($con, $delSql);
            if($delRes){
                // echo 1;
                for($i=0; $i<count($itemName);$i++){
                    $newProduct = "INSERT INTO invoice_items(invoice_id,item_name, item_quantity, item_rate, item_amount)
                                VALUES('$invoice_id', '$itemName[$i]', '$itemQuantity[$i]', '$itemRate[$i]', '$itemAmt[$i]')";
                    $newProductResult = mysqli_query($con, $newProduct);
                }
                if($newProduct){
                    $updateNewInvoice = "UPDATE invoice SET
                    subTotal = '$subTotal',
                    amount = '$grandTotal', 
                    tax = '$tax', 
                    discount = '$discount', 
                    WHERE invoice_id = '$invoice_id'
                    ";
                    $updateNewInvoiceRes = mysqli_query($con, $updateNewInvoice);
                    if($updateNewInvoice){
                        // echo '1';
                        echo 
                            '
                            <script>
                            alert("Updated Successfully..!");
                            location.href = "./viewInvoice.php";
                            </script>
                            ';
                    }
                    else{
                        // echo 'error from updateNewInvoice'. mysqli_error($con);
                        echo 
                    '
                    <script>
                    alert("Some Error occured Try again later..! 2");
                    location.href = "./main.php";
                    </script>
                    ';
                    }
                }else{
                    //echo 'error from newProduct'. mysqli_error($con);
                    echo 
                    '
                    <script>
                    alert("Some Error occured Try again later..! 2");
                    location.href = "./main.php";
                    </script>
                    ';
                }
            }else{
                // echo "error ".mysqli_error($con);
                echo 
                    '
                    <script>
                    alert("Some Error occured Try again later..! 2");
                    location.href = "./main.php";
                    </script>
                    ';
            }
            // $idSql = "select item_id from invoice_items where invoice_id = '$invoice_id'";
            // $idResult = mysqli_query($con, $idSql);
            // $row = mysqli_fetch_all($idResult);
            // if($row){
            //     //$num = $row[0];
            //     // $count = count($row);
            //     // for($i=0; $i<count($itemName);$i++){
            //     //     // echo $_POST['itemName'][$i]."<br/>";

            //     //     if(!($itemName[$i] > $row[$i])){
            //     //         $itemSql = "UPDATE invoice_items SET 
            //     //         invoice_id='$invoice_id',
            //     //         item_name='".$_POST['itemName'][$i]."', 
            //     //         item_quantity='".$_POST['itemQuantity'][$i]."', 
            //     //         item_rate = '".$_POST['itemRate'][$i]."',
            //     //         item_amount = '".$_POST['itemAmt'][$i]."' WHERE item_id = '".$row[$i][0]."'";
            //     //         //echo 'ok';
            //     //     }else if()
            //     //     else{
            //     //         // echo $itemName[$i]. mysqli_error($con);
            //     //         $newProduct = "INSERT INTO invoice_items(invoice_id,item_name, item_quantity, item_rate, item_amount)
            //     //         VALUES('$invoice_id', '$itemName[$i]', '$itemQuantity[$i]', '$itemRate[$i]', '$itemAmt[$i]')";
            //     //         $newProductResult = mysqli_query($con, $newProduct);
            //     //         if($newProduct){
            //     //             $updateNewInvoice = "UPDATE invoice SET
            //     //             subTotal = '$subTotal',
            //     //             amount = '$grandTotal', 
            //     //             tax = '$tax', 
            //     //             discount = '$discount', 
            //     //             WHERE invoice_id = '$invoice_id'
            //     //             ";
            //     //             $updateNewInvoiceRes = mysqli_query($con, $updateNewInvoice);
            //     //             if($updateNewInvoice){
            //     //                 echo '1';
            //     //             }else{
            //     //                 echo 'error from updateNewInvoice'. mysqli_error($con);
            //     //             }
            //     //         }else{
            //     //             echo 'error from newProduct'. mysqli_error($con);
            //     //         }
            //     //     }
            //     //     $itemResult = mysqli_query($con, $itemSql);
            //     // }
            //     // if($itemResult){
            //     //     echo 1;
            //     // }else{
            //     //     echo mysqli_error($con);
            //     // }
            //     // // foreach($itemName as $key => $value){
            //     // //     $itemSql = "UPDATE invoice_items SET 
            //     // //     invoice_id='$invoice_id',
            //     // //     item_name='$value['item_name']', 
            //     // //     item_quantity='$itemQuantity[$key]['item_quantity']', 
            //     // //     item_rate = '$itemRate[$key]['item_rate']',
            //     // //     item_amount = '$itemAmt[$key]' WHERE invoice_id = '$invoice_id'";
            //     // // }
            //     if($itemResult){
            //         // echo 
            //         // '
            //         // <script>
            //         // alert("Updated Successfully..!");
            //         // location.href = "./viewInvoice.php";
            //         // </script>
            //         //';
            //     }else{
            //         // echo 
            //         // '
            //         // <script>
            //         // alert("Some Error occured Try again later..! 2");
            //         // location.href = "./main.php";
            //         // </script>
            //         // ';
            //         echo 'error'.mysqli_error($con);
                    
            //     }
            // }else{
            //     // echo 'id not found';
            //     echo 
            //     '
            //     <script>
            //     alert("Some Error occured Try again later..! 1");
            //     location.href = "./main.php";
            //     </script>
            //     ';
            // }
        }else{
            echo 'error'.mysqli_error($con);
            // echo 
            // '
            // <script>
            // //alert("Some Error occured Try again later..! 0");
            // //location.href = "./main.php";
            // </script>
            // ';
        }
    }
}