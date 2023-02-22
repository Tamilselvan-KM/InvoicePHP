<?php
session_start();
include_once 'includes/connection.php';
$data = json_decode(file_get_contents("php://input"));

$firstName = $data->firstName;
$lastName  = $data->lastName;
$email     = $data->email;
$password = password_hash($data->password, PASSWORD_DEFAULT);
$address = $data->address;
$city = $data->city;
$postalCode = $data->postalCode;
$state =$data->state;
$country = $data->country;

$sql = "select firstName from users where firstName='$firstName'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
if($row){
    echo "firstName";
}else{
    $sql_stmt = $con->prepare("INSERT INTO users (email, password, firstName, lastName, address, city, state, postalCode, country)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sql_stmt->bind_param("sssssssis", $email, $password, $firstName, $lastName, $address, $city, $state, $postalCode, $country);
if($sql_stmt->execute()){
    echo 1;
    $_SESSION['firstName'] = $firstName;
}else{
    echo 0;
}
$sql_stmt->close();
$con->close();
}