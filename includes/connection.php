<?php

$con = new mysqli('localhost', 'root', '', 'invoicetask');

if($con->connect_error){
    echo 'error occured';
}