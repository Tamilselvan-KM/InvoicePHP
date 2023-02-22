<?php
session_start();
$fn="";
if(isset($_SESSION['firstName'])){
    $fn = $_SESSION['firstName'];
}
?>
<div class="container my-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../main.php">INVOICE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Invoice
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="" method="post" id="new_invoice">
                                    <a class="dropdown-item" href="../invoice.php">Add New</a>
                                </form>
                            </li>
                            <li><a class="dropdown-item" href="../viewInvoice.php">View List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Clients
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../client.php">Add New</a></li>
                            <li><a class="dropdown-item" href="../viewClients.php">View Clients</a></li>

                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href=""><?php echo $fn?></a></li>
                            </ul>
                        </li>
                    </ul>
                    <a href="logout.php" class="btn mt-1">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</div>