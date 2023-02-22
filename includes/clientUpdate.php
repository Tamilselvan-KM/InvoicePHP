<?php
session_start();
include_once 'connection.php';
$data = json_decode(file_get_contents("php://input"));

$clientId = $data->clientId;
$firstName = $data->firstName;
$lastName  = isset($data->lastName) ? $data->lastName : 'NULL';
$email     = $data->email;
$address     = isset($data->address) ? $data->address : 'NULL';
$city = isset($data->city) ? $data->city : 'NULL';
$postalCode = isset($data->postalCode) ? $data->postalCode : 'NULL';
$state = isset($data->state) ? $data->state : 'NULL';
$country = isset($data->country) ? $data->country : 'NULL';
$phone = $data->phone;
$taxNumber = $data->taxNumber;
$notes = isset($data->notes) ? $data->notes : 'NULL';
$userid =  isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;

$sql_stmt = $con->prepare("UPDATE clients SET firstName =?,lastName =?, email=?,city =?,postalCode =?,state =?,country =?,
        address =?,contact =?,taxNumber =?,notes =?,user_id =? WHERE client_id =?");
$sql_stmt->bind_param('ssssisssidsii', $firstName, $lastName, $email, $city, $postalCode, $state, $country,
             $address, $phone, $taxNumber, $notes, $userid,$clientId);
if($sql_stmt->execute()){
    echo 1;
}else{
    echo 0;
}
$sql_stmt->close();
$con->close();