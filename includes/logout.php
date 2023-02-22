<?php
session_start();
unset($_SESSION['firstName']);
if(session_destroy()){
    echo 
    '
    <script>
        alert("Logout successful");
        location.href = "../login.php";
    </script>
    ';
}