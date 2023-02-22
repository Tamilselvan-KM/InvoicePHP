<?php
include_once('includes/header.php');
include_once('includes/connection.php');
include_once('includes/nav.php');
$sql_stmt = $con->prepare("SELECT * FROM clients");
$sql_stmt->execute();
$result = $sql_stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <h3 class="text-center">Clients List</h3>
    <?php
        if($users){
            // var_dump($users);
            foreach($users as $row){
                echo '<div class="card" style="height:90px">
                <div class="card-body d-flex justify-content-between">
                    <div class="checkbox">
                        <a href="" class="btn delClient" title="delete client">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <div class="clientInfo">
                        <p style="font-size:14px">
                            <span>'.$row['firstName'].'</span><br>
                            <span>'.$row['email'].'</span><br>
                            <span>'.$row['contact'].'</span><br>
                        </p>
                    </div>
                    <div class="actions">
                        <a href="editClient.php?cid='.$row['client_id'].'" title="edit client" class="me-1 btn"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="invoice.php?q='.$row['client_id'].'" title="new invoice" class="me-1 btn"><i class="fa-solid fa-plus"></i></a>
                        <a href="viewInvoice.php?q='.$row['client_id'].'" title="view invoice" class="me-1 btn"><i class="fa-solid fa-eye"></i></a>
                    </div>
                </div>
            </div>
            <hr/>
            ';
            }
        }else{
            echo "<h2 class='text-center'>No Clients Here! <br/> <a class='btn btn-success' href='./client.php'>Add New</a>";
        }
        $sql_stmt->close();
        $con->close();
        
    ?>

</div>
<script src="./js/clientDelete.js"></script>
<?php
include_once('includes/footer.php');